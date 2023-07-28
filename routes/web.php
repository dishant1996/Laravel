<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
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
Route::get('/',[DemoController::class,'welcomew'])->name('home'); 


// Route::get('/{new}',[DemoController::class,'welcomew'])->name('home'); 
//new string is passed which is also needed to pass in controller function method

Route::get('/user',[DemoController::class,'userw']);
// ->name('user');  
 //userw is method created in controller

Route::get('/blog',[DemoController::class,'showblog'])->name('blog'); //anchor