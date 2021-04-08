<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeadminController;
use App\Http\Controllers\DashboardController;
//use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', [HomeController::class, 'index']);

//Route::get('get-more-users', 'HomeController@getMoreUsers')->name('users.get-more-users');




Route::get('/', [CollegeadminController::class, 'index']);



Auth::routes();
Route::get('/addbranch', [CollegeadminController::class, 'addBranch']);
Route::get('/addstate', [CollegeadminController::class, 'addState']);
Route::get('/addcity', [CollegeadminController::class, 'addCity']);
Route::get('/addcourses', [CollegeadminController::class, 'addCourse']);
Route::get('/addcoursefees', [CollegeadminController::class, 'addCoursefees']);
Route::get('/addcoursemapping', [CollegeadminController::class, 'addCourseMapping']);
Route::get('/addadmissionprocess', [CollegeadminController::class, 'addAdmissionprocess']);
Route::get('/addfacilities', [CollegeadminController::class, 'addFacilities']);
Route::get('/addcollegefacilities', [CollegeadminController::class, 'addCollegeFacilities']);
Route::get('/addhostel', [CollegeadminController::class, 'addHostel']);

Route::get('/newcollege', [CollegeadminController::class, 'newCollege']);
Route::get('/newcoursesfees', [CollegeadminController::class, 'newCoursesfees']);



Route::get('/importfile', [CollegeadminController::class, 'importCSVfile']);
Route::post('/upload/college', [CollegeadminController::class, 'import'])->name('import-file');
Route::get('/download/college', [CollegeadminController::class, 'exportCollege'])->name('export-college-details');

Route::get('/home', [CollegeadminController::class, 'homePage']);


Route::post('/savenewcollege', [CollegeadminController::class, 'saveCollege'])->name('add-college');
Route::post('/savenewbranch', [CollegeadminController::class, 'saveBranch'])->name('add-branch');
Route::post('/savenewstate', [CollegeadminController::class, 'saveState'])->name('add-state');
Route::post('/savenewcity', [CollegeadminController::class, 'saveCities'])->name('add-city');
Route::post('/savenewcourse', [CollegeadminController::class, 'saveCourses'])->name('add-course');
Route::post('/savenewcoursefes', [CollegeadminController::class, 'saveCoursefees'])->name('add-coursefees');
Route::post('/savecoursemapping', [CollegeadminController::class, 'saveCourseMapping'])->name('add-coursemapping');
Route::post('/saveadmissionprocess', [CollegeadminController::class, 'saveAdmissionprocess'])->name('add-admissionprocess');
Route::post('/savefacilities', [CollegeadminController::class, 'saveFacilities'])->name('add-facilities');

Route::post('/savecollegefacilities', [CollegeadminController::class, 'saveCollegeFacilities'])->name('add-collegefacilities');
Route::post('/savehosteles', [CollegeadminController::class, 'saveHosteles'])->name('add-hostel');

Route::get('/collegedetail/{collegeurl}/{tab_name?}', [CollegeadminController::class, 'detail']);



Route::get('/index', [CollegeadminController::class, 'view']);
Route::get('/index/list/{state}', [CollegeadminController::class, 'view']);
Route::get('/index/list/{state}/{city}/', [CollegeadminController::class, 'view']);
Route::get('/index/{branch_name}', [CollegeadminController::class, 'view']);




Auth::routes();



Route::post('get-cities',[CollegeadminController::class,'getCities'])->name('get-cities');
Route::post('get-colleges',[CollegeadminController::class,'getColleges'])->name('get-colleges');
