<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterService
{
    protected $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function createUser($request)
    {
        try {
            $userData = array(
                "name" => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'zip' => $request->zip,
                'how_do_you_know_about_garcia' => $request->how_do_you_know_about_garcia,
                'terms_and_conditions' => $request->terms_and_conditions
            );

            $this->users->insert($userData);

            return $this->navigateToApplyCourse($request);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            throw new \Exception($th->getMessage());
        }
    }

    public function navigateToApplyCourse($request){
        try {
            if(Auth::attempt(["email"=>$request->email, "password"=>$request->password])){
                return 'all_course';
            }
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            throw new \Exception($th->getMessage());
        }
    }
}