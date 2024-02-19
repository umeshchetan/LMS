<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('pages.initialPage');
    }

    // public function userProfile(){
    //     return view('pages.userProfile');
    // }
}
