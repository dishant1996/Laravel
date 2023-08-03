<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Newcontroller;
use App\Http\Middleware\webguard;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route:: get('/hello',function(){
//     return "hello";
// });
// Route::get("/employees",[DemoController::class,"index"]);


//this is post method below:-

Route::post('/student',[StudentsController::class,'CreateStudents']);
Route::get('/getstudent',[StudentsController::class,'Getstudents']);
Route::post('/val',[StudentsController::class,'ValidateStudents']);
Route::get('/getid/{id}',[ApiController::class,'Getid']);
Route::put('/updatename/{fname}',[ApiController::class,'updatename']);
Route::get('/hello',[StudentsController::class,'gethello']);

Route::post('register', [Newcontroller::class, 'register']);
Route::post('login', [Newcontroller::class, 'login']);
Route::post('/profile',[Newcontroller::class,'profile']);
Route::post('/logout',[Newcontroller::class,'logout']);



