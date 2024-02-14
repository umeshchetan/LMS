<?php

namespace App\Http\Controllers;

use App\Services\RegisterService;
use Illuminate\Http\Request;
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
            // dd($request->toArray());
            $validate = \Validator::make($request->all(), [
                "name" => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                "date_of_birth" => 'required',
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $reqToReturn = $req->createUser($request);

            return redirect()->route($reqToReturn)->with('success', "Registration success...");
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new \Exception($th->getMessage());
        }
    }
}
