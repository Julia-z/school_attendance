<?php

namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use Illuminate\Http\Request;
use app\Http\ORM\Student;
class TestExcelController extends Controller
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
      Excel::create('Filename', function($excel) {

        $excel->sheet('Sheetname', function($sheet) {

            // Sheet manipulation

        });

      })->export('xlsx');

    }


}
