<?php

use App\Http\Controllers\JobController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List Jobs
Route::get('/jobs',[JobController::class,'index']);

//single job
Route::get('/jobs/{id}',[JobController::class,'show']);

//create new Job
Route::post('/job',[JobController::class,'store']);

//update Job
Route::put('/jobs',[JobController::class,'store']);

//delete job
Route::delete('/jobs',[JobController::class,'destroy']);


