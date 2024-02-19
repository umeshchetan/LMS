<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    protected $users;
    protected $order;
    protected $course;

    public function __construct()
    {
        $this->users = new User();
        $this->order = new Order();
        $this->course = new Course();
    }

    public function getAllCourse(){
        try {
            $course = $this->course->getCourses();
            // dd($course);
            return $course;
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return new \Exception($th->getMessage());
        }
    }

    public function userDetails($request)
    {
        // dd($request->toArray());
        try {
            if($request->has("courseType")){
                if($request->courseType == "Subscription"){
                    $type = $request->courseType;
                }else{
                    $type = "Maincourse";
                    $plan = "";
                    $notice = $this->can_user_Purchase($request->courseid);
                }
            }
            
            return [
                "courseDetails" => $this->course->getCourseDataById($request->courseid),
                "courseType" => $type,
                "userDetails" => Auth::user(),
                'plan' => $plan, 
                // 'notice' => $notice 
            ];
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return new \Exception($th->getMessage());
        }
    }

    public function can_user_Purchase($courseId){
        if(Auth::user()->is_course_purchased != false){
            return "You have already purchased the course...";
        }else{
            return "";
        }
    }
}