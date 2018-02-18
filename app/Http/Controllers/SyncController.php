<?php

namespace App\Http\Controllers;

use Request;
use DateTime;
use app\Http\Requests;
use Auth;
use DB;
use Schema;



// Documentation to add a new table is available in the bottom of the page.

class SyncController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $students = DB::connection('sqlite')->table('student')->get();

    }

  }
