<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('test', function(){
  return view('layouts.dashboard');
});

Route::get('excel', 'TestExcelController@index');

Route::get('/dashboard', 'DashboardController@index');
Route::auth();

Route::get('register_student', 'RegisterStudentController@index');

Route::get('/register', 'AddEditController@index');
Route::post('post_student', 'PostStudentController@store');
Route::get('/register_family', 'RegisterGuardianController@index');
Route::post('/post_family', 'PostGuardianController@store');
Route::get('/register_admin', 'RegisterAdminController@index');
Route::post('/post_admin', 'PostAdminController@store');
Route::get('/validate_student', 'CheckStudentController@index');

// API
Route::post('api/login', 'APi\AttendanceApi@login');
Route::post('api/register', 'APi\AttendanceApi@register');
Route::post('api/edit_student', 'APi\AttendanceApi@edit_student');
//
//
// Route::post('/send-sms', [
//    'uses'   =>  'SmsController@getUserNumber',
//    'as'     =>  'sendSms'
// ]);
