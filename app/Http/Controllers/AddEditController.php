<?php

namespace App\Http\Controllers;

use Request;
use DateTime;
use app\Http\Requests;
use Auth;
use DB;
use Schema;

use app\Http\DatabaseFieldNames\DBEvent;

use app\Http\ORM\Hotline;
use app\Http\ORM\Comment;
use app\Http\ORM\Systemusers;
use app\Http\DatabaseFieldNames\DBComment;

// Documentation to add a new table is available in the bottom of the page.

class AddEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($sql_error = false, $sql_success = false, $page_col_selected = array(), $page_selected_id = '')
    {

        // page details
        $page_title = "Add/Edit Data";

        $page_selected_table = 'system_users';
        $page_col_name = array();
        $page_col_is_list = array();
        $page_col_value = array();
        $page_col_display = array();
        $page_id_name = '';

        if(!is_null(Request::get('page_selected_table'))) {
            $page_selected_table = Request::get('page_selected_table');
        }

        if(!is_null(Request::get('page_selected_id'))) {
            $page_selected_id = Request::get('page_selected_id');
        } else {
            $page_selected_id = '0';
        }

        $supported_tables = array('student');

        // regardless of new or old, fill out name, is_list, value, and display
        AddEditController::generate($page_selected_table, $page_col_name, $page_col_is_list, $page_id_name);

        if ($page_selected_table == 'student') {

            //  
            $employer_id_list = DB::table('employer')->pluck('employer_id');
            $employer_id_disp = array();
            sanitize_single_column('employer_id', $employer_id_list, $employer_id_disp);

            // role
            $role_id_list = DB::table('role')->pluck('role_id');
            $role_id_disp = array();
            sanitize_single_column('role_id', $role_id_list, $role_id_disp);

            $page_col_value = array('', '', '', '', '', '', $employer_id_list, $role_id_list, array(0, 1), array(0, 1), array(0, 1), array(0, 1), array(0, 1), array(0, 1), array(0, 1));
            $page_col_display = array('', '', '', '', '', '', $employer_id_disp, $role_id_disp, array(0, 1), array(0, 1), array(0, 1), array(0, 1), array(0, 1), array(0, 1), array(0, 1));

        }

        // now show the displayed values
        // if we are coming from an edit, maintain $page_col_selected
        if(count($page_col_selected) == count($page_col_name)) { //here ??
            // maintain it.
        }

        // otherwise if it's a new entry, put default values.
        else if($page_selected_id == '0') {
            for($i = 0; $i < count($page_col_name); $i++) {
                if($page_col_is_list[$i])
                    $page_col_selected[$i] = 0;
                else
                    $page_col_selected[$i] = '';
            }
        }

        // otherwise load data and put it here.
        else {
            $curr_user = DB::table($page_selected_table)->where($page_id_name, '=', $page_selected_id)->first();
            for($i = 0; $i < count($page_col_name); $i++) {
                $col_val = $curr_user->{$page_col_name[$i]};
                if($page_col_is_list[$i])
                    $page_col_selected[$i] = is_null($col_val) ? 0 : $col_val;
                else
                    $page_col_selected[$i] = is_null($col_val) ? '' : $col_val;

            }
        }

        return view('dashboard.add_edit', compact('page_title', 'page_picker_top_right', 'sql_error', 'sql_success',
                    'page_selected_id', 'page_selected_table', 'page_id_name',
                    'page_col_name', 'page_col_is_list', 'page_col_value', 'page_col_display', 'page_col_selected',
                    'supported_tables', 'dynamic_tables_list'));
    }

    public function store() {
        $sql_error = false;
        $sql_success = false;
        try {
            $page_selected_id = Request::get('page_selected_id');
            $page_id_name = Request::get('page_id_name');
            $page_selected_table = Request::get('page_selected_table');
            $page_col_name = array();
            $page_col_is_list = array();
            $page_col_selected = array();
            $page_col_value = array();

            EditController::generate($page_selected_table, $page_col_name, $page_col_is_list, $page_id_name); //here ??

            $update_array = array();
            foreach($page_col_name as $col) {
              if($col == 'steel_tank' && Request::get($col) == ''){
                $update_array[$col] = Request::get($col);
                $page_col_selected[] = Request::get($col);
              }
            }
            if($page_selected_id == '0') {
                // add missing data that is not visible to user
                if($page_selected_table == 'system_users') {
                    $update_array['password'] = '4a7d1ed414474e4033ac29ccb8653d9b';
                } else if($page_selected_table == 'truck') {
                    $update_array['frequency'] = 0;
                } else if($page_selected_table == 'tank') {
                    $update_array['fill_rate'] = 0;
                } else if($page_selected_table == 'building') {
                    $update_array['time_created'] = new DateTime();
                }
                // insert into table and fetch id.
                DB::table($page_selected_table)->insert($update_array);
                $page_selected_id = DB::table($page_selected_table)->orderBy('created_at', 'desc')->first()->{$page_id_name};
            } else {
                // set updated_at to now and update table
                $update_array['updated_at'] = new DateTime();
                DB::table($page_selected_table)->where($page_id_name, '=', $page_selected_id)
                                               ->update($update_array);
                if($is_null_steel_tank){
                  DB::table($page_selected_table)
                      ->where($page_id_name, '=', $page_selected_id)
                      ->update(['steel_tank' => NULL]);
                }
            }
            $sql_success = true;
        } catch (\Exception $e) {
          dd($e);
            $sql_error = true;
        }

        return EditController::index($sql_error, $sql_success, $page_col_selected, $page_selected_id);
    }

    private function generate($table_name, &$page_col_name, &$page_col_is_list, &$page_id_name) {
        if($table_name == 'student') {
            $page_col_name = array('first_name_en', 'middle_name_en', 'last_name_en', 'first_name_ar', 'middle_name_ar','last_name_ar',
                                    'gender', 'mother_tongue', 'home_address_en', 'home_address_ar',
                                    'date_of_birth', 'class_id', 'active');

            $page_col_is_list = array(false, false, false, false, false, false,
                                        true, true, false, false, false,
                                      false, true, true
                                    );
            $page_id_name = 'student_id';

        }
    }
}

/***********************************************************************************
How to add a new table to add/edit:

First, add the table to the $supported_tables array

Then update the generate function to return for this table the page_col_names (all editabled cols) in
$page_col_name, whether they are a list (true) or regular entry (false) (ie if enum or foriegn key or bool
they are a list) in $page_col_is_list. Finally include the id field in $page_id_name.

Then in the condition statement that follows the call to generate, retrieve any foriegn key
values, sanitize them and add them to the two arrays. For other lists (enums or bools) simply
add a list with the possible values (eg: array(0, 1) for bool) to the two lists. Follow the
first example to the letter and you should be fine.

Note: the firsta parameter of sanitize_single_column is not the name of the id, but the name
of the column that contains the FK in the table we want to edit.

Finally, in the store function, under the comment 'add missing data that is not visible to user'
do exactly that. This includes things such as hashing passwords, or filling in things the user
shouldn't have access to such the fill_rate for tanks, etc ...

AND YOU'RE DONE :D.
************************************************************************************/
