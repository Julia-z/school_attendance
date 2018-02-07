<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;
use DB;
use App\Http\ORM\Student;
use App\Http\ORM\Identification;
use App\Http\ORM\MedicalInfo;
use Auth;

class PostStudentController extends Controller
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
        $official_id_type = '';
        $official_id_number = '';

        $first_name_en = '';
        $middle_name_en = '';
        $last_name_en = '';

        $first_name_ar = '';
        $middle_name_ar = '';
        $last_name_ar = '';

        $gender = '';
        $tongue = '';

        $date_of_birth = '';
        $class_id = '';

        $address_en = '';
        $address_ar = '';

        $disability_desc = '';
        $disability_type = '';

        $sql_success = true;
        $sql_error_std_id = '';

        try{
          $student_id = getGUID();
          //name en
          $first_name_en = Request::get('first_name_en');
          $middle_name_en = Request::get('middle_name_en');
          $last_name_en = Request::get('last_name_en');

          //name ar
          $first_name_ar = Request::get('first_name_ar');
          $middle_name_ar = Request::get('middle_name_ar');
          $last_name_ar = Request::get('last_name_ar');

          //official_id
          $official_id = getGUID();
          $official_id_type = Request::get('official_id_type');
          $official_id_number = Request::get('official_id_number');
          $nationality = Request::get('nationality');

          //check if id already exists

          Identification::create([
            'official_id' => $official_id,
            'official_id_type' => $official_id_type,
            'official_id_number' => $official_id_number,
            'nationality' => $nationality,
          ]);
          //
          $gender = Request::get('gender');
          $tongue = Request::get('mother_tongue');

          $date_of_birth = Request::get('date_of_birth');
          $class_id = Request::get('class_id');

          $address_en = Request::get('home_address_en');
          $address_ar = Request::get('home_address_ar');

          $medical_info_id = getGUID();
          $disability_type_id  = Request::get('disability_type');
          $school_id = Auth::user()->school_id;

          if($disability_type_id > 0){
            $disability_desc = Request::get('disability_desc');

            MedicalInfo::create([
              'medical_info_id' => $medical_info_id,
              'disability_id' => $disability_desc,
              'details' => $disability_desc,
            ]);
          }
            Student::create([
            'student_id' => getGUID(),
            'official_id' => $official_id,
            'first_name_en' => $first_name_en,
            'middle_name_en' => $middle_name_en,
            'last_name_en' => $last_name_en,

            'school_id', $school_id,

            'first_name_ar' => $first_name_ar,
            'middle_name_ar' => $middle_name_ar,
            'last_name_ar' => $last_name_ar,

            'gender' => $gender,
            'mother_tongue' => $tongue,

            'date_of_birth' => $date_of_birth,

            'home_address_en' => $address_en,
            'home_address_ar' => $address_ar,

            'medical_info_id' => $medical_info_id,
            'class_id' => $class_id,
            'active' => 1,

          ]);
        } catch (\Exception $e) {
          dd($e);
          $sql_success = false;
        }
        return view('dashboard.post_student_result', compact('sql_success', 'sql_error_std_id'));
    }
}
