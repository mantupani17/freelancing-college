<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\FacilitiesController;
use App\Http\Controllers\Api\CollegeHostelController;
use App\Http\Controllers\Api\AdmissionController;

/*

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

//Route::post("add",[ApiFormController::class,'add']);
//getCourseDetail
Route::get("course/fees", 'Api\CourseController@getCourseFees');
Route::get("facilities", 'Api\FacilitiesController@getFacilities');
Route::get("hosteles", 'Api\CollegeHostelController@getHostelFacilities');
Route::get("admissionprocess", 'Api\AdmissionController@getAdmissionProcess');