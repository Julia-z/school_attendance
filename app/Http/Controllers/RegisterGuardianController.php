<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;
use DB;
use app\Http\ORM\Student;
class RegisterGuardianController extends Controller
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
        $all_fields = ['guardian_id', 'student_id', 'relationship_id',
                      'first_name_en', 'last_name_en',
                      'first_name_ar', 'last_name_en',
                      'phone',
                      'send_sms_to'];

        $filtered_fields = ['student_number', 'relationship_id',
                            'first_name_en', 'last_name_en',
                            'first_name_ar', 'last_name_ar',
                            'phone',
                            'send_sms_to'
                          ];

        $filtered_fields_names = sanitize_static_names_arr($filtered_fields);
        //get those who are required
        $required = array();
        get_required('student', $filtered_fields, $required);

        //get those who are visible
        $visible = array();
        get_visible('student', $filtered_fields, $visible);

        //get their data types
        $data_types = ['text', 'list',
                        'text-en',  'text-en',
                        'text-ar',  'text-ar',
                        'phone',
                        'list'
                      ];

        //TODO

        $relationship_ids = DB::table('relationship')
                                    ->pluck('relationship_id');
        $relationship_names = DB::table('relationship')
                                    ->pluck('relationship_name');

        $data_list_values = ['', $relationship_ids,
                              '', '',
                              '', '',
                              '',
                              array(1, 0)
                            ];
        $static_display = array_fill(0, count($filtered_fields_names), false);
        $data_list_display = [
                              '', $relationship_names,
                              '', '',
                              '', '',
                              '',
                              array('yes', 'no')
                            ];

        return view('dashboard.register_guardian', compact('filtered_fields', 'filtered_fields_names', 'required',
                    'visible', 'data_types', 'data_list_values', 'data_list_display', 'static_display'
                    )
                  );
        return view('dashboard.register_guardian', compact('student_id'));
    }


}
