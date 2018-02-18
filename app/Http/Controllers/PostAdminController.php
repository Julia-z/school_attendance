<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;
use DB;
use Auth;
use App\User;

class PostAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store()
    {
        $sql_success = true;
        $user_first_name = '';
        $user_last_name = '';

        $email = '';
        $password = '';
        $permissions = 2;


        try{
          $user_first_name = Request::get('first_name');
          $user_last_name = Request::get('last_name');

          $eamil = Request::get('email');
          $pwd = Request::get('password');
          $perm = Request::get('permissions');

          $password = bcrypt($pwd);
          $permissions = ($perm == 'unrwa_admin') ?1: 2;
          $school_id = (Auth::user()->school_id != null)? Auth::user()->school_id : Request::get('school_id');
          $school_id = ($school_id == "-")? null : $school_id;
          User::create([
            'id' => getGUID(),
            'user_first_name' => $user_first_name,
            'user_last_name' => $user_last_name,
            'email' => $eamil,
            'password' => $password,
            'permissions' => $permissions,
            'school_id' => $school_id,
            'md5_pwd' => md5($pwd)
          ]);
        } catch (\Exception $e) {
          dd($e);
          $sql_success = false;
        }
        return view('dashboard.post_admin_result', compact('sql_success'));
    }
}
