<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
class RootController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


}
