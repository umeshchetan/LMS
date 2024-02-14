<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // public function __construct(Request $request){
    //     // Check if there is no authenticated user using the 'sanctum' guard.
    //     if(!$request->user('sanctum')){
    //         // If there is no authenticated user, apply the 'auth' middleware.
    //         $this->middleware('auth');
    //     }
    // }
    public function index(){
        return view('pages.allCourse');
    }
}
