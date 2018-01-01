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
    // $students = DB::table('users')->get();
    // return $students;
    DB::table('users')->insert(['email' => 'juliaelzini@gmail.com', 'password' => bcrypt('hello'),
    'user_first_name' => 'Julia', 'user_last_name' => 'Z']
    );
});

Route::auth();

Route::get('/register', 'RegisterController@index');
