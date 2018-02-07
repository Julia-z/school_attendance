<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use App\Http\ORM\Student;
use App\Http\ORM\Identification;
use App\Http\ORM\MedicalInfo;
use Illuminate\Http\Request;

class CheckStudentController extends Controller
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

    public function index(Request $request)
    {
      $unique_params = $request->all();
      $std = DB::table('student')->where($unique_params)->get();
      $result = ($std == null)? 1 : 0;
      return response()->json(
                        array('valid'=> $result
                              ),200
                          );
    }


}
