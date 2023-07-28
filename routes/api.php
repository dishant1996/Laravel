<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\StudentsController;
use App\Models\ApiStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/students',[StudentsController::class,'CreateStudents']);
Route::get('/getstudents',[StudentsController::class,'Getstudents']);

