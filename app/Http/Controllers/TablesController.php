<?php

namespace App\Http\Controllers;

use Request;
use DateTime;
use app\Http\Requests;
use Auth;
use DB;
use Schema;




class TablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($page_table_name ='' , $page_selected_district = 0, $page_selected_from = '', $page_selected_to = '')
    {

        // req_limiter array stores what limiter is requried for every table.
        // 0 => no limit required
        // 1 => limit by district
        // 2 => limit by time range
        $req_limiter = array();
        $req_limiter['school'] = 0;
        $req_limiter['class'] = 0;


        // page details
        $page_title = "Tables Data";

        if($page_table_name == '') { // ie not from delete
            if(!is_null(Request::get('table_name'))) {
                $page_table_name = Request::get('table_name');
            } else {
                $page_table_name = 'school';
            }
        }

        $page_req_limiter = $req_limiter[$page_table_name];


        $table_out_query = array();
        try {
            if($page_req_limiter == 0) {
                $raw_table_out_query = DB::table($page_table_name)->get();
            }
        } catch(\Exception $e) {
            //TODO(emad): fix;
            dd($e);
        }

        // table data master arrays
        $req_cols_for_db = array();
        $id_col_name = array();
        $req_cols_for_db['school'] = array('school_id', 'school_name', 'school_address', 'weekend_days');
        $req_cols_for_db['class'] = array('class_id', 'school_id', 'grade', 'section', 'class_name');

        $id_col_name['school'] = 'school_id';
        $id_col_name['class'] = 'class_id';



        $copy_of_cols = $req_cols_for_db[$page_table_name];
        $req_cols_for_db[$page_table_name] = array();
        $table_out_query = array();
        sanitzie_data_v2($raw_table_out_query, $copy_of_cols, $req_cols_for_db[$page_table_name],
                            $table_out_query, $id_col_name[$page_table_name]);

        return view('dashboard.tables', compact('page_title', 'page_picker_top_right', 'page_table_name',
                                                'page_req_limiter', 'page_selected_district', 'page_selected_from', 'page_selected_to',
                                                'req_cols_for_db', 'table_out_query', 'id_col_name'));
    }

    public function delete() {
        if(request()->isMethod('post')){
            if(Schema::hasColumn($_POST['table_name'], 'is_deleted')) {
                DB::table($_POST['table_name'])->where($_POST['col_name'], '=', $_POST['page_selected_delete_id'])->update(array('is_deleted' => true));
            } else {
                DB::table($_POST['table_name'])->where($_POST['col_name'], '=', $_POST['page_selected_delete_id'])->delete();
            }
        }
        return self::index($_POST['table_name'], $_POST['page_selected_district'], $_POST['page_selected_from'], $_POST['page_selected_to']);
    }
}
