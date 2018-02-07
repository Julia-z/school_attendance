<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use app\Http\ORM\Student;
use DB;
use Auth;

class RegisterStudentController extends Controller
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
        //get all fields of student table
        $all_fields = ['student_id', 'student_number', 'official_id', 'school_id',
                        'first_name_en', 'middle_name_en', 'last_name_en',
                        'first_name_ar', 'middle_name_ar', 'last_name_ar',
                        'gender', 'mother_tongue', 'medical_info_id', 'home_address_en', 'home_address_ar',
                        'date_of_birth', 'class_id', 'active'
                      ];

        $filtered_fields = ['official_id_type', 'official_id_number',
                            'first_name_en', 'middle_name_en', 'last_name_en',
                            'first_name_ar', 'middle_name_ar', 'last_name_ar',
                            'gender', 'mother_tongue', 'disability_type',
                             'home_address_en', 'home_address_ar',
                            'date_of_birth', 'class_id', 'active'
                          ];

        $filtered_fields_names = sanitize_static_names_arr($filtered_fields);
        //get those who are required
        $required = array();
        get_required('student', $filtered_fields, $required);

        //get those who are visible
        $visible = array();
        get_visible('student', $filtered_fields, $visible);

        //get their data types
        $data_types = ['list', 'text',
                        'text-en', 'text-en', 'text-en',
                        'text-ar', 'text-ar', 'text-ar',
                        'list', 'list', 'list',
                        'text-en', 'text-ar',
                        'date', 'list', 'list'
                      ];

        //TODO
        $school_id = Auth::user()->school_id;
        //get default values for dropdown menus
        $classes_ids = DB::table('class')->where('school_id', '=', $school_id)
                                    ->pluck('class_id');
        $classes_names = DB::table('class')->where('school_id', '=', $school_id)
                                    ->pluck('class_name');
        $disabilities_ids = DB::table('disabilities')->pluck('disability_id');
        array_unshift($disabilities_ids, 0);
        $disabilities_names = DB::table('disabilities')->pluck('disability_type');
        array_unshift($disabilities_names, 'None');

        $data_list_values = [array('unicef', 'passport'), '',
                              '', '', '',
                              '', '', '',
                              array('F', 'M'), array('Arabic', 'French', 'English') , $disabilities_ids,
                              '', '',
                              '', $classes_ids, array(1, 0)
                            ];
        $static_display = array_fill(0, count($filtered_fields_names), false);
        $static_display[count($static_display) - 2] = true;
        $data_list_display = [
                              array('UNICEF', 'Passport'), '',
                              '', '', '',
                              '', '', '',
                              array('Female', 'Male'), array('Arabic', 'French', 'English') ,  $disabilities_names,
                              '', '',
                              '', $classes_names, array('Active', 'Non-active')
                            ];
        $validate_check_against = ['first_name_en', 'middle_name_en', 'last_name_en', 'date_of_birth'];

        return view('dashboard.register_student', compact('filtered_fields', 'filtered_fields_names', 'required',
                    'visible', 'data_types', 'data_list_values', 'data_list_display', 'validate_check_against', 'static_display'
                    )
                  );
    }


}
