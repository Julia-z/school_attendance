<?php

use app\Http\ORM\Student;


function return_if_not_null($obj, $property, $default) {
    try {
        if(is_null($obj)) { return $default; }
        if(is_null($obj->{$property})) { return $default; }
        return $obj->{$property};
    } catch (\Exception $e) {
        return $default;
    }
}

function access_level($req) {
    if(is_null(Auth::user()->permissions)) return false;

    return ($req >= Auth::user()->permissions);
}

function get_required($table_name, $fields, &$required){
  foreach($fields as $field){
    if (is_required($table_name, $field)){
      $required[] = 1;
    }
    else{
      $required[] = 0;
    }
  }
}
function get_visible($table_name, $fields, &$visible){
  foreach($fields as $field){
    if (is_visible($table_name, $field)){
      $visible[] = 1;
    }
    else{
      $visible[] = 0;
    }
  }
}
function is_required($table_name, $column_name){
    $required = array();

    // student table
    $required["student"] = array();
    $required["student"]["student_id"] = 1;
    $required["student"]["student_number"] = 1;
    $required["student"]["official_id"] = 1;
    $required["student"]["school_id"] = 1;
    $required["student"]["first_name_en"] = 1;
    $required["student"]["middle_name_en"] = 1;
    $required["student"]["last_name_en"] = 1;
    $required["student"]["first_name_ar"] = 1;
    $required["student"]["middle_name_ar"] = 1;
    $required["student"]["last_name_ar"] = 1;
    $required["student"]["gender"] = 1;
    $required["student"]["mother_tongue"] = 1;
    $required["student"]["medical_info_id"] =0;
    $required["student"]["home_address_en"] = 1;
    $required["student"]["home_address_ar"] = 1;
    $required["student"]["date_of_birth"] = 1;
    $required["student"]["class_id"] = 1;
    $required["student"]["active"] = 0;

    // event table
    $required["event"] = array();
    $required["event"]["event_id"] = 1;
    $required["event"]["student_id"] = 1;
    $required["event"]["student_RFID_tag"] = 1;
    $required["event"]["timestamp"] = 1;

    // family_member table
    $required["family_member"] = array();
    $required["family_member"]["student_id"] = 1;
    $required["family_member"]["relationship"] = 1;
    $required["family_member"]["first_name_en"] = 1;
    $required["family_member"]["last_name_en"] = 1;
    $required["family_member"]["first_name_ar"] = 1;
    $required["family_member"]["last_name_ar"] = 1;
    $required["family_member"]["phone"] = 1;
    $required["family_member"]["address_en"] = 1;
    $required["family_member"]["address_ar"] = 1;
    $required["family_member"]["send_sms_to"] = 1;

    // student_rfid table
    $required["student_rfid"] = array();
    $required["student_rfid"]["student_id"] = 1;
    $required["student_rfid"]["RFID_tag1"] = 1;
    $required["student_rfid"]["RFID_tag2"] = 1;

    // holiday table
    $required["holiday"] = array();
    $required["holiday"]["holiday_id"] = 1;
    $required["holiday"]["school_id"] = 1;
    $required["holiday"]["holiday_title"] = 1;
    $required["holiday"]["holiday_date"] = 1;
    $required["holiday"]["sms_content"] = 1;

    // school table
    $required["school"] = array();
    $required["school"]["school_id"] = 1;
    $required["school"]["school_name"] = 1;
    $required["school"]["school_address"] = 1;
    $required["school"]["weekend_days"] = 1;

    // user table
    $required["user"] = array();
    $required["user"]["id"] = 1;
    $required["user"]["user_first_name"] = 1;
    $required["user"]["user_last_name"] = 1;
    $required["user"]["email"] = 1;
    $required["user"]["password"] = 1;
    $required["user"]["school_id"] = 1;

    // permission table
    $required["permission"] = array();
    $required["permission"]["user_id"] = 1;
    $required["permission"]["URL_permitted"] = 1;

    // identification table
    $required["identification"] = array();
    $required["identification"]["official_id"] = 1;
    $required["identification"]["official_id_type"] = 1;
    $required["identification"]["id_number"] = 1;
    $required["identification"]["nationality"] = 1;

    // class table
    $required["class"] = array();
    $required["class"]["class_id"] = 1;
    $required["class"]["school_id"] = 1;
    $required["class"]["grade"] = 1;
    $required["class"]["section"] = 1;

    // medical_info table
    $required["medical_info"] = array();
    $required["medical_info"]["medical_info_id"] = 1;
    $required["medical_info"]["medical_info_description"] = 1;

    // relationship table
    $required["relationship"] = array();
    $required["relationship"]["relationship_id"] = 1;
    $required["relationship"]["relationship_name"] = 1;
    if(array_key_exists($table_name, $required) && array_key_exists($column_name, $required[$table_name]))
      return $required[$table_name][$column_name];
    else return 1;
}

function is_visible($table_name, $column_name){
    $visible = array();

    // student table
    $visible["student"] = array();
    $visible["student"]["student_id"] = 1;
    $visible["student"]["student_number"] = 1;
    $visible["student"]["official_id"] = 1;
    $visible["student"]["school_id"] = 1;
    $visible["student"]["first_name_en"] = 1;
    $visible["student"]["middle_name_en"] = 1;
    $visible["student"]["last_name_en"] = 1;
    $visible["student"]["first_name_ar"] = 1;
    $visible["student"]["middle_name_ar"] = 1;
    $visible["student"]["last_name_ar"] = 1;
    $visible["student"]["gender"] = 1;
    $visible["student"]["mother_tongue"] = 1;
    $visible["student"]["medical_info_id"] = 1;
    $visible["student"]["home_address_en"] = 1;
    $visible["student"]["home_address_ar"] = 1;
    $visible["student"]["date_of_birth"] = 1;
    $visible["student"]["class_id"] = 1;
    $visible["student"]["active"] = 0;

    // event table
    $visible["event"] = array();
    $visible["event"]["event_id"] = 1;
    $visible["event"]["student_id"] = 1;
    $visible["event"]["student_RFID_tag"] = 1;
    $visible["event"]["timestamp"] = 1;

    // family_member table
    $visible["family_member"] = array();
    $visible["family_member"]["student_id"] = 1;
    $visible["family_member"]["relationship"] = 1;
    $visible["family_member"]["first_name_en"] = 1;
    $visible["family_member"]["last_name_en"] = 1;
    $visible["family_member"]["first_name_ar"] = 1;
    $visible["family_member"]["last_name_ar"] = 1;
    $visible["family_member"]["phone"] = 1;
    $visible["family_member"]["address_en"] = 1;
    $visible["family_member"]["address_ar"] = 1;
    $visible["family_member"]["send_sms_to"] = 1;

    // student_rfid table
    $visible["student_rfid"] = array();
    $visible["student_rfid"]["student_id"] = 1;
    $visible["student_rfid"]["RFID_tag1"] = 1;
    $visible["student_rfid"]["RFID_tag2"] = 1;

    // holiday table
    $visible["holiday"] = array();
    $visible["holiday"]["holiday_id"] = 1;
    $visible["holiday"]["school_id"] = 1;
    $visible["holiday"]["holiday_title"] = 1;
    $visible["holiday"]["holiday_date"] = 1;
    $visible["holiday"]["sms_content"] = 1;

    // school table
    $visible["school"] = array();
    $visible["school"]["school_id"] = 1;
    $visible["school"]["school_name"] = 1;
    $visible["school"]["school_address"] = 1;
    $visible["school"]["weekend_days"] = 1;

    // user table
    $visible["user"] = array();
    $visible["user"]["id"] = 1;
    $visible["user"]["user_first_name"] = 1;
    $visible["user"]["user_last_name"] = 1;
    $visible["user"]["email"] = 1;
    $visible["user"]["password"] = 1;
    $visible["user"]["school_id"] = 1;

    // permission table
    $visible["permission"] = array();
    $visible["permission"]["user_id"] = 1;
    $visible["permission"]["URL_permitted"] = 1;

    // identification table
    $visible["identification"] = array();
    $visible["identification"]["official_id"] = 1;
    $visible["identification"]["official_id_type"] = 1;
    $visible["identification"]["id_number"] = 1;
    $visible["identification"]["nationality"] = 1;

    // class table
    $visible["class"] = array();
    $visible["class"]["class_id"] = 1;
    $visible["class"]["school_id"] = 1;
    $visible["class"]["grade"] = 1;
    $visible["class"]["section"] = 1;

    // medical_info table
    $visible["medical_info"] = array();
    $visible["medical_info"]["medical_info_id"] = 1;
    $visible["medical_info"]["medical_info_description"] = 1;

    // relationship table
    $visible["relationship"] = array();
    $visible["relationship"]["relationship_id"] = 1;
    $visible["relationship"]["relationship_name"] = 1;

    if(isset($visible[$table_name][$column_name]))
      return $visible[$table_name][$column_name];
    else return 1;
}

function sanitize_static_names($src) {
    $words = explode("_", $src);
    $ret = "";
    foreach ($words as $i => $w) {
      if($i > 0 ) $ret .= " ";
      if($w != 'en' && $w != 'ar')
        $ret .= ucfirst($w);
      else if($w != 'id')
        $ret .= "(" . ucfirst($w) . ")";
        else
        $ret .= "(" . "" . ")";
      if($i > 0 ) $ret .= " ";
    }
    return $ret;
    // $STATIC_NAMES_DICT = [
    //
    //     //table names
    //     'student' => 'db.student',
    //     'event' =>  'db.event' ,
    //     'family_member' =>  'db.family_member' ,
    //     'student_RFID' =>  'db.student_RFID' ,
    //     'holiday' =>  'db.holiday' ,
    //     'school' =>  'db.school' ,
    //     'permissions' =>  'db.permissions' ,
    //     'identification' =>  'db.identification' ,
    //     'class' =>  'db.class' ,
    //     'medical_info' =>  'db.medical_info' ,
    //
    //
    //             // //column names
    //             // //student table
    //             // 'student_id' =>  'db.student_id' ,
    //             // 'student_number' =>  'db.student_number' ,
    //             // 'official_id' =>  'db.official_id' ,
    //             // 'school_id' =>  'db.school_id' ,
    //             // 'first_name_en' =>  'db.first_name_en' ,
    //             // 'middle_name_en' =>  'db.middle_name_en' ,
    //             // 'last_name_en' =>  'db.last_name_en' ,
    //             // 'first_name_ar' =>  'db.first_name_ar' ,
    //             // 'middle_name_ar' =>  'db.middle_name_ar' ,
    //             // 'last_name_ar' =>  'db.last_name_ar' ,
    //             // 'gender' =>  'db.gender' ,
    //             // 'mother_tongue' =>  'db.mother_tongue' ,
    //             // 'medical_info_id' =>  'db.medical_info_id' ,
    //             // 'home_address_en' =>  'db.home_address_en' ,
    //             // 'home_address_ar' =>  'db.home_address_ar' ,
    //             // 'date_of_birth' =>  'db.date_of_birth' ,
    //             // 'class_id' =>  'db.class_id' ,
    //             // 'active' =>  'db.active' ,
    //             //
    //             // 'official_id_type' => __('db.official_id_type'),
    //     //different
    // ];
    // if(array_key_exists($src, $STATIC_NAMES_DICT)) {
    //     return $STATIC_NAMES_DICT[$src];
    // } else {
    //     return $src;
    // }
}

function sanitize_static_names_arr($src_arr) {
    $dest_arr = array();
    foreach($src_arr as $src) {
        $dest_arr[] = sanitize_static_names($src);
    }
    return $dest_arr;
}

function sanitize_static_names_2d_arr($src_arr, &$dest_arr) {
    $dest_arr = array();
    foreach($src_arr as $index => $src) {
        // can we translate the index?
        $new_ind = sanitize_static_names($index);
        $dest_arr[$new_ind] = sanitize_static_names_arr($src);
    }
    return $dest_arr;
}

function getGUID(){
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
    return strtolower($uuid);
}

// function access_level($req) {
//     if(is_null(Auth::user()->permissions)) return false;
//
//     return ($req >= Auth::user()->permissions);
// }
