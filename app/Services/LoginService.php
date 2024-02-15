<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Log;

class LoginService
{
    protected $orders;

    public function __construct(){
        $this->orders = new Order();
    }

    public function loginUser($request){
        try {
            if(Auth::attempt(["email"=> $request->email, "password" => $request->password])){
                $userId = Auth::id();
                $user = User::find($userId);
                // dd($user);

                // check if user has orders in order table and navigate according to it
                $userPurchased = $this->orders->getOrderDetails($userId);
                // dd($userPurchased);
                if($userPurchased){
                    return $this->Navigate_To_ApplyCourse();
                }else{
                    return $this->Navigate_To_MyCourse();
                }
            }else{
                // If authentication fails dispaly error message...
                return redirect()->back()->with('error', 'Not a valid user...');
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new \Exception($th->getMessage());
        }
    }

    public function Navigate_To_ApplyCourse(){
        try {
            return "all_course";
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new \Exception($th->getMessage());
        }
    }

    public function Navigate_To_MyCourse(){
        try {
            return "my_course";
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new \Exception($th->getMessage());
        }
    }

}