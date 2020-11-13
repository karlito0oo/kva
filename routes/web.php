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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// advisers
Route::resource('/api/advisers', 'AdvisersController');
Route::get('/home/advisers', 'AdvisersController@AdviserHome');

// school-years
Route::resource('/api/school-years', 'SchoolYearsController');
Route::get('/home/school-years', 'SchoolYearsController@schoolYearHome');

// Levels
Route::resource('/api/levels', 'LevelsController');
Route::get('/home/levels', 'LevelsController@levelsHome');

// Students
Route::resource('/api/students', 'StudentsController');
Route::get('/home/students', 'StudentsController@studentsHome');