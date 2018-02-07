<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use app\Http\ORM\Student;
use DB;
class RegisterAdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools_names = DB::table('school')->pluck('school_name');
        $schools_ids = DB::table('school')->pluck('school_id');
        return view('dashboard.register_admin', compact('schools_names', 'schools_ids'));
    }


}
