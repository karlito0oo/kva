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
Route::post('/api/users/fetchAdvisers', 'UsersController@fetchAdvisers');

//framework
Route::post('/api/loggedinUser', 'HomeController@loggedinUser');
Route::post('/api/uploadImage/{do}', 'ImageUploadController@index');

// advisers
Route::resource('/api/advisers', 'AdvisersController');
Route::get('/home/advisers', 'AdvisersController@AdviserHome');

// school-years
Route::resource('/api/school-years', 'SchoolYearsController');
Route::get('/home/school-years', 'SchoolYearsController@schoolYearHome');
Route::post('/api/school-years/fetch', 'SchoolYearsController@fetch');

// Levels
Route::resource('/api/levels', 'LevelsController');
Route::get('/home/levels', 'LevelsController@levelsHome');
Route::post('/api/levels/fetch', 'LevelsController@fetch');

// Students
Route::resource('/api/students', 'StudentsController');
Route::get('/api/students/send-fully-verify-link/{id}', 'StudentsController@sendFullyVerifyLink');
Route::get('/api/students/fully-verify/{id}', 'StudentsController@fullyVerify');
Route::get('/home/students', 'StudentsController@studentsHome');
Route::get('/home/students/level/{level_id}', 'StudentsController@studentsHome');

// Settings
Route::resource('/api/settings', 'SettingsController');
Route::get('/home/settings', 'SettingsController@pageHome');
Route::post('/api/setting/fetch', 'SettingsController@fetch');

// Subjects
Route::resource('/api/subjects', 'SubjectsController');
Route::get('/home/subjects', 'SubjectsController@pageHome');
Route::post('/api/subjects/fetch', 'SubjectsController@fetch');

// Request
Route::resource('/api/requests', 'RequestsController');
Route::get('/home/requests', 'RequestsController@pageHome');

// Enrollment
Route::resource('/api/admin/enrollment', 'EnrollmentAdminController');
Route::get('/home/admin/enrollment', 'EnrollmentAdminController@pageHome');

// Sections
Route::resource('/api/sections', 'SectionsController');
Route::get('/home/sections', 'SectionsController@pageHome');
Route::post('/api/sections/fetch', 'SectionsController@fetch');
Route::post('/api/sections/updateAdvisers', 'SectionsController@updateAdvisers');
Route::post('/api/sections/studentSubjects', 'SectionsController@studentSubjects');
Route::post('/api/sections/updateStudentGrade', 'SectionsController@updateStudentGrade');

// About Us
Route::resource('/about-us', 'AboutUsController');


//--------------------Students

//Enrollment
Route::resource('/api/enrollments', 'EnrollmentsController');
Route::get('/home/enrollments', 'EnrollmentsController@pageHome');
Route::patch('/api/enrollments/submitEnrollment/{id}', 'EnrollmentsController@submitEnrollment');
Route::post('/api/enrollments/checkEnrollmentDetails', 'EnrollmentsController@checkEnrollmentDetails');



//Printable reports
Route::get('print/exportStudents/{type}/{id}/{preview}', 'PDFExportsController@exportStudents');
Route::get('print/exportGoodmoral/{id}/{preview}', 'PDFExportsController@exportStudentGoodMoral');
Route::get('print/exportRegForm/{id}/{preview}', 'PDFExportsController@exportStudentRegForm');
Route::get('print/grade-fees/{id}', 'PDFExportsController@exportGradeFees');