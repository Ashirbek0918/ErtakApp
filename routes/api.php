<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login',[EmployeeController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('feedback/create',[EmployeeController::class ,'writefeedback']);
    Route::get('users' ,[EmployeeController::class, 'getUsers']);
});

Route::post('create/voice',[UserController::class,'addvoice']);
Route::get('user/voices',[UserController::class,'getVoice']);
