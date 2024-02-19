<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        "course_type",
        "course_name",
        "course_description",
        "course_price",
        "course_online_subject",
        "course_online_message",
        "course_image"
    ];

    public function getCourses(){
        return Course::all();
    }

    public function getCourseDataById($courseId){
        return $this->where('id',$courseId)->first();
    }
}
