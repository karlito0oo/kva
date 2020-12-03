<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//users
Route::resource('/api/users', 'UsersController');

//framework
Route::post('/api/loggedinUser', 'HomeController@loggedinUser');
Route::post('/api/uploadImage/{do}', 'ImageUploadController@index');

// advisers
Route::resource('/api/advisers', 'AdvisersController');
Route::get('/home/advisers', 'AdvisersController@AdviserHome');

// school-years
Route::resource('/api/school-years', 'SchoolYearsController');
Route::get('/home/school-years', 'SchoolYearsController@schoolYearHome');

// Levels
Route::resource('/api/levels', 'LevelsController');
Route::get('/home/levels', 'LevelsController@levelsHome');
Route::post('/api/levels/fetch', 'LevelsController@fetch');

// Students
Route::resource('/api/students', 'StudentsController');
Route::get('/home/students', 'StudentsController@studentsHome');

// Subjects
Route::resource('/api/subjects', 'SubjectsController');
Route::get('/home/subjects', 'SubjectsController@pageHome');


//--------------------Students

//registration
Route::get('/home/registration', 'RegistrationsController@pageHome');