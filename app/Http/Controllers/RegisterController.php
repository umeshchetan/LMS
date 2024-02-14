<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterService $req ,Request $request)
    {
        try {
           
            $validate = \Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric',
                'date_of_birth' => 'required|date',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
                'address' => 'required',
                'country'=> 'required',
                'state' => 'required',
                'city' => 'required',
                'zip' => 'required|min:6',
                'terms_and_condition' => 'accepted',
            ]);
            
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $reqToReturn = $req->createUser($request);
            // return redirect()->route($reqToReturn);
            return redirect()->route($reqToReturn)->with('success', 'Registration successful!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new \Exception($th->getMessage());
        }
    }
}
