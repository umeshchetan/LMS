<?php

use App\Http\Controllers\AuthorizeController;
use App\Http\Controllers\AuthorizeNet;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
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

//Login 
Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('postlogin',[LoginController::class,'login'])->name('postLogin');

Route::group(['middleware'=>'auth'],function(){
// logout
Route::get('logout',[LoginController::class,'logout'])->name('logout');
// navigate course Page
Route::get('/courses',[CourseController::class,'index'])->name('all_course');
Route::get('/my_course',[CourseController::class,'my_course'])->name('my_course');
Route::match(['get', 'post'],'/apply_course',[CourseController::class,'apply_course'])->name('apply_course');

// payment
Route::post('pay',[AuthorizeNet::class,'payment'])->name('pay');
Route::post('dopay/online',[AuthorizeNet::class,'handlePayment'])->name('dopay.online');

});