<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\Models\Paymentlog;

use Illuminate\Http\Request;
use PharIo\Manifest\Email;

class AuthorizeNet extends Controller
{

    protected $users;
    protected $order;

    public function __construct()
    {
        $this->users = new User();
        $this->order = new Order();
    }
    public function payment(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                // dd($request->all());
                $data = $request->except(['_token']);
                // dd($data);
                return view('pages.payment', compact('data'));
            } catch (\Throwable $th) {
                \Log::error($th->getMessage());
                throw new \Exception(__('error.message.404 - Server payment gateway not conneted'));
            }
        }
    }

    public function handlePayment(Request $request)
    {
        // dd($request->all());
        // $required = array('name', 'email', 'phone', 'address', 'country', 'state', 'courseprice', 'netprice', 'zip', 'cvv', 'cardNumber');

        $input = $request->all();
        // dd('input',$input);

        /* Create a merchantAuthenticationType object with authentication details
      retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();

        if ($request->courseType == "Maincourse") {
            $merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));
        }

        // Set the transaction's refId
        $refId = 'ref' . time();
        // dd('refId',$refId); // ref1708171834

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($input['card_number']);
        $creditCard->setExpirationDate($input['expiration_year'] . "-" . $input['expiration_month']);
        $creditCard->setCardCode($input['cvv']);

        // dd($creditCard);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // dd($paymentOne);
        // Create order information
        // $order = new AnetAPI\OrderType();
        // $order->setInvoiceNumber("10101");
        // $order->setDescription("Golf Shirts");

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($input['name']);
        // $customerAddress->setLastName("Johnson");
        // $customerAddress->setCompany("Souveniropolis");
        $customerAddress->setAddress($input['address']);
        // $customerAddress->setCity();
        $customerAddress->setState($input['state']);
        $customerAddress->setZip($input['zip']);
        $customerAddress->setCountry($input['country']);

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        // $customerData->setType("individual");
        // $customerData->setId("99999456654");
        $customerData->setEmail($input['email']);

        // dd($customerAddress);

        // Add values for transaction settings
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");

        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.
        // $merchantDefinedField1 = new AnetAPI\UserFieldType();
        // $merchantDefinedField1->setName("customerLoyaltyNum");
        // $merchantDefinedField1->setValue("1128836273");

        // $merchantDefinedField2 = new AnetAPI\UserFieldType();
        // $merchantDefinedField2->setName("favoriteColor");
        // $merchantDefinedField2->setValue("blue");

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($input['amount']);
        // $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);

        // dd($transactionRequestType);
        // $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        // $transactionRequestType->addToUserFields($merchantDefinedField1);
        // $transactionRequestType->addToUserFields($merchantDefinedField2);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // dd($request);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);


        if ($response != null) {
            // dd($response);
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    try {
                        echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                        echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                        echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                        echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                        echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";

                        Paymentlog::create([
                            "amount" => $input["amount"],
                            "name_on_card" => Auth::user()->name,
                            "response_code" => $tresponse->getResponseCode(),
                            "transaction_id" => $tresponse->getTransId(),
                            "auth_id" => Auth::id(),
                            "message_code" => $tresponse->getMessages()[0]->getCode(),
                            "qty" => 1
                        ]);
                        $this->users->updateUserOrder(Auth::id(), true);
                        $this->order->updateOrderTable($input, $tresponse->getTransId());

                    } catch (\Exception $e) {
                        // Handle exceptions gracefully
                        // Log the error or display a user-friendly message
                        // For example:
                        \Log::error('Error creating payment log: ' . $e->getMessage());
                        // You may also want to return a response indicating that there was an error
                        return response()->json(['error' => 'An error occurred while processing the payment.'], 500);
                    }
                } else {
                    echo "Transaction Failed \n";
                    if ($tresponse->getErrors() != null) {
                        echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                        echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                echo "Transaction Failed \n";
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                    echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                } else {
                    echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                    echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
                }
            }
        } else {
            echo "No response returned \n";
        }

        return redirect()->route('my_course')->with('');
    }

    public function updateOrderTable($input, $transid)
    {
        $todayDate = Carbon::now()->format('Y-m-d H:i:s');

        // Calculate the expiration date (1 year from now)
        $ExpireDate = Carbon::parse($todayDate)->addYear()->format('Y-m-d H:i:s');

        $orderData = array(
            'paymentid' => $transid,
            'coursetype' => "main",
            'orderid' => $transid,
            'courseid' => 10,
            'amount' => $input["amount"],
            'userid' => Auth::id(),
            'email' => Auth::user()->email,
            // 'currency' => "USD",
            'status' => 'success',
            "created_at" => $todayDate,
            "expired_at" => $ExpireDate,
        );

        $this->order->paymentid = $orderData['paymentid'];
        $this->order->coursetype = $orderData['coursetype'];
        $this->order->courseid = $orderData['orderid'];
        $this->order->courseid = $orderData['courseid'];
        $this->order->amount = $orderData['amount'];
        $this->order->userid = $orderData['userid'];
        $this->order->email = $orderData['email'];
        // $this->order->currency = $orderData['currency'];
        $this->order->status = $orderData['status'];
        $this->order->created_at = $orderData['created_at'];
        $this->order->expired_at = $orderData['expired_at'];

        // Update the Order model attributes and save
        $this->order->save();
    }
}
