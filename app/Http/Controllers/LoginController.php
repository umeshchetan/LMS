<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginService $req, Request $request)
    {
        try {
            $validate = \Validator::make($request->all(), [
                "email" => "required",
                "password" => "required"
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $reqToReturn = $req->loginUser($request);
            // dd($reqToReturn);
            return redirect()->route($reqToReturn)->with('success', "Login success...");
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            // If authentication fails return back to login form 
            return back();
        }
    }

    public function logout()
    {
        $user = Auth::user();

        // Revoke all of the user's tokens
        $user->tokens()->delete();
        Auth::logout();

        return redirect()->route('login')->with('success', 'Logout success...');
    }
}
