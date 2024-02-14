<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[UserController::class,'index'])->name('intialPage');

// Register
Route::get('register',[RegisterController::class,'index'])->name('register');
Route::post('postregister',[RegisterController::class,'store'])->name('postregister');

// navigate to all course Page
Route::get('/courses',[CourseController::class,'index'])->name('all_course');