<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CourseService;
use App\Traits\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    use Responder;
    // public function __construct(Request $request){
    //     // Check if there is no authenticated user using the 'sanctum' guard.
    //     if(!$request->user('sanctum')){
    //         // If there is no authenticated user, apply the 'auth' middleware.
    //         $this->middleware('auth');
    //     }
    // }
    public function index(CourseService $req, Request $request){
        $data = $req->getAllCourse();
        return view('pages.allCourse', compact('data'));
    }
    
    public function my_course(){
        return view('pages.my_course');
    }

    public function apply_course(CourseService $req, Request $request){
        try {
            // dd($request->toArray());
            $user = $req->userDetails($request);
            // dd($user);
            return view('pages.apply_course', compact('user'));
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            throw new \Exception($th->getMessage());
        }
        
    }
}
