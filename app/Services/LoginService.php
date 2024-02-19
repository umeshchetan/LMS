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

                // create a token
                $user = auth()->user();
                $token = $user->createToken($request->email)->plainTextToken;
                // dd($token);
                // dd($user);
                // check if user has orders in order table and navigate according to it
                $userPurchased = $this->orders->getOrderDetails($userId);

                // dd($userPurchased);
                if($userPurchased){
                    return $this->Navigate_To_MyCourse();
                }else{
                    return $this->Navigate_To_ApplyCourse();
                }
            }else{
                // If authentication fails dispaly error message... and in controller add this in catch method return back();
                return redirect()->back()->with('error', 'Invalid credentials. Please try again with valid credentials..');
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