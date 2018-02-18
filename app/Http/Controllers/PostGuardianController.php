<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;
use DB;
use App\Http\ORM\Guardian;

class PostGuardianController extends Controller
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
        $sql_message = '';
        $first_name_en = '';
        $last_name_en = '';

        $first_name_ar = '';
        $last_name_ar = '';

        $phone_number = '';

        $relationship_name = '';
        $receive_sms = '';


        try{
          $student_first_name_en = Request::get('student_first_name_en');
          $student_middle_name_en = Request::get('student_middle_name_en');
          $student_last_name_en = Request::get('student_last_name_en');
          $student_date_of_birth = Request::get('student_date_of_birth');

          $student= DB::table('student')->where('first_name_en', '=', $student_first_name_en)
                                        ->where('middle_name_en', '=', $student_middle_name_en)
                                        ->where('last_name_en', '=', $student_last_name_en)
                                        ->where('date_of_birth', '=', $student_date_of_birth)
                                                ->first();
          if($student == null){
            $sql_success = false;
            $sql_message = 'no_student';
          }

          else{
            $student_id = $student->student_id;
            $guardian_id = getGUID();

            $first_name_en = Request::get('first_name_en');
            $last_name_en = Request::get('last_name_en');

            $first_name_ar = Request::get('first_name_ar');
            $last_name_ar = Request::get('last_name_ar');

            $phone_number = Request::get('phone_number');

            $address_en = Request::get('address_en');
            $address_ar = Request::get('address_ar');

            $relationship_id = Request::get('relationship_id');
            $receive_msgs = Request::get('receive_msgs');

            $sms = ($receive_msgs == "yes" || $receive_msgs == 1) ? '1' : '0';

          Guardian::create([
            'student_id' => $student_id,
            'guardian_id' => $guardian_id,

            'first_name_en' => $first_name_en,
            'last_name_en' => $last_name_en,

            'first_name_ar' => $first_name_ar,
            'last_name_ar' => $last_name_ar,

            'phone' => $phone_number,

            'address_en' => $address_en,
            'address_ar' => $address_ar,

            'relationship_id' => $relationship_id,
            'send_sms_to' => $sms

          ]);
        }
        } catch (\Exception $e) {
          dd($e);
          $sql_success = false;
        }
        return view('dashboard.post_guardian_result', compact('sql_success', 'sql_message'));
    }
}
