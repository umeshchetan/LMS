<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(LoginService $req, Request $request){
        try {
            $validate = \Validator::make($request->all(),[
                "email" => "required",
                "password" => "required"
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $reqToReturn = $req->loginUser($request);

            return redirect()->route($reqToReturn)->with('success',"Login success...");
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return new \Exception($th->getMessage());
        }
    }
}
