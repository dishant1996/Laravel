<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/profile',[UserController::class,'profile']);
Route::post('/logout',[UserController::class,'logout']);


