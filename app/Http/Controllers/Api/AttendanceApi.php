<?php

namespace App\Http\Controllers\Api;

use app\Strings\AllStrings;
use Request;
use App\Http\ORM\Identification;
use App\Http\ORM\Student;
use App\Http\ORM\MedicalInfo;


use app\Http\DatabaseFieldNames\DBComment;

use DateTime;
use DB;
use stdClass;

use App\Responses\Response;


class AttendanceApi extends Controller
{

  public function login(){
    try{
      // missing username
      if(is_null(Request::get('username'))){

          $return = new stdClass;
          $return->status = 400;
          $return->error = 'Please provide a username';

          error_log(json_encode($return),0);
          return json_encode($return);
      }
      //missing password
      if(is_null(Request::get('password'))){
        $return = new stdClass;
        $return->status = 400;
        $return->error = 'Please provide a password';

        error_log(json_encode($return),0);
        return json_encode($return);
      }

      $username = Request::get('username');
      $password = Request::get('password');
      $timestamp = '0000-00-00 00:00:00';

      if(!is_null(Request::get('timestamp'))) $timestamp = Request::get('timestamp');
        $user = $this->Verfiy_User($username,$password);
        if($user == false){
          $return = new stdClass;
          $return->status = 401;
          $return->error = 'Incorrect username or password';

          error_log(json_encode($return),0);
          return json_encode($return);
        }
        else{
          //list of school admins
          $admins = $this->GetSchoolAdmins($timestamp);
          $classes = $this->GetClasses($timestamp);
          $students = $this->GetStudents($timestamp);
          $official_ids = $this->GetOfficialIds($timestamp);
          $medicalInfos = $this->GetMedicalInfos($timestamp);
          $disabilities = $this->GetDisabilityInfo($timestamp);

          $return = new stdClass;
          $return->status = 200;

          $response = new stdClass;
          $response->status = 1;
          $response->message = "Successful login";
          $return->response = $response;

          $return->school_admins = $admins;
          $return->classes = $classes;
          $return->students = $students;
          $return->official_ids = $official_ids;
          $return->medical_infos = $medicalInfos;
          $return->disabilities = $disabilities;

          error_log(json_encode($return),0);
          return json_encode($return);

        }
      }catch (\Exception $e) {
        $return = new stdClass;
        $return->status = 500;
        $return->error = 'Something went wrong. Please try again later.';

        error_log(json_encode($return),0);
        return json_encode($return);
      }
  }

  public function register(){
    // missing username
      if(is_null(Request::get('username'))){
        $return = new stdClass;
        $return->status = 400;
        $return->error = 'Please provide a username';

        error_log(json_encode($return),0);
        return json_encode($return);
      }
      //missing password
      if(is_null(Request::get('password'))){
        $return = new stdClass;
        $return->status = 400;
        $return->error = 'Please provide a password';

        error_log(json_encode($return),0);
        return json_encode($return);
      }

      $username = Request::get('username');
      $password = Request::get('password');
      $students = Request::get('students');

      $user = $this->Verfiy_User($username,$password);
      if($user == false){
        $return = new stdClass;
        $return->status = 401;
        $return->error = 'Incorrect username or password';

        error_log(json_encode($return),0);
        return json_encode($return);
      }
      else{
        //try to insert all the Students
        $count_failures = 0;
        $names = "";
        foreach($students as $std){
          try{
            $first_name_en = $std['first_name_en'];
            $middle_name_en = $std['middle_name_en'];
            $last_name_en =  $std['last_name_en'];
            $date_of_birth = $std['date_of_birth'];

            $dup = DB::table('student')->where('first_name_en', '=', $first_name_en)
                                      ->where('middle_name_en', '=', $middle_name_en)
                                      ->where('last_name_en', '=', $last_name_en)
                                      ->where('date_of_birth', '=', $date_of_birth)
                                      ->first();
            if($dup != null){
              $count_failures += 1;
              $names .= $first_name_en . " " . $middle_name_en . " " . $last_name_en. ", ";
            }
            else{
              $student_id = getGUID();

              //name ar
              $first_name_en = $std['first_name_en'];
              $middle_name_en = $std['middle_name_en'];
              $last_name_en =  $std['last_name_en'];

              //name ar
              $first_name_ar = $std['first_name_ar'];
              $middle_name_ar = $std['middle_name_ar'];
              $last_name_ar =  $std['last_name_ar'];

              //official_id
              $official_id = getGUID();
              $official_id_type = $std['official_id_type'];
              $official_id_number = $std['official_id_number'];
              $nationality = $std['nationality'];

              Identification::create([
                'official_id' => $official_id,
                'official_id_type' => $official_id_type,
                'official_id_number' => $official_id_number,
                'nationality' => $nationality,
              ]);
              //
              $gender = $std['gender'];
              $tongue = $std['mother_tongue'];

              $class_id =$std['class_id'];

              $address_en = $std['home_address_en'];
              $address_ar = $std['home_address_ar'];

              $medical_info_id = null;
              $disability_id  = $std['disability_id'];
              $school_id = $std['school_id'];
              if($disability_id > 0){
                $medical_info_id = getGUID();
                MedicalInfo::create([
                  'medical_info_id' => $medical_info_id,
                  'disability_id' => $disability_id,
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
            }
          } catch (\Exception $e) {
          //  dd($e);
            $sql_success = false;
          }
        }
        $return = new stdClass;
        $return->status = 200;

        $response = new stdClass;

        if($count_failures > 0){
          $response->status = 0;
          $s = ($count_failures > 1)? 's' : '';
          $is_are = ($count_failures > 1)? 'are' : 'is';
          $response->message = $count_failures . " student" . $s . " whose name" . $s . " " .$is_are . ": " . substr($names, 0, strlen($names) - 2)
                                  . " should be validated from the website!";
        }
        else{
          $response->status = 1;
          $response->message = count($students) + " successfully Added";
        }


        $return->response = $response;
        error_log(json_encode($return),0);
        return json_encode($return);

       }

  }

  public function edit_student(){
    // missing username
      if(is_null(Request::get('username'))){
        $return = new stdClass;
        $return->status = 400;
        $return->error = 'Please provide a username';

        error_log(json_encode($return),0);
        return json_encode($return);
      }
      //missing password
      if(is_null(Request::get('password'))){
        $return = new stdClass;
        $return->status = 400;
        $return->error = 'Please provide a password';

        error_log(json_encode($return),0);
        return json_encode($return);
      }


      $username = Request::get('username');
      $password = Request::get('password');

      $user = $this->Verfiy_User($username,$password);
      //authentication error
      if($user == false){
        $return = new stdClass;
        $return->status = 401;
        $return->error = 'Incorrect username or passowrd';

        error_log(json_encode($return),0);
        return json_encode($return);
      }
      else{
        $first_name_en = Request::get('first_name_en');
        $middle_name_en = Request::get('middle_name_en');
        $last_name_en = Request::get('last_name_en');
        $date_of_birth = Request::get('date_of_birth');

        $missing = '';
        if(is_null($first_name_en)) $missing = 'First name (En)';
        else if(is_null($middle_name_en)) $missing = 'Middle name (En)';
        else if(is_null($last_name_en)) $missing = 'Last name (En)';
        else if(is_null($date_of_birth)) $missing = 'Date of birth';

        if(strlen($missing) > 0){
          $return = new stdClass;
          $return->status = 400;
          $return->error = $missing . ' is missing';

          error_log(json_encode($return),0);
          return json_encode($return);
        }

        else{
          $std = DB::table('student')->where('first_name_en', '=', $first_name_en)
                                    ->where('middle_name_en', '=', $middle_name_en)
                                    ->where('last_name_en', '=', $last_name_en)
                                    ->where('date_of_birth', '=', $date_of_birth)
                                    ->first();
          //if student does not exist
          if($std == null){
            $return = new stdClass;
            $return->status = 200;

            $response = new stdClass;
            $response->status = 0;
            $response->error = 'Student whose name is ' . $first_name_en . ' ' . $middle_name_en . ' ' . $last_name_en
                                . ' and birth date is ' . $date_of_birth . ' does not exist!';

            $return->response = $response;
            error_log(json_encode($return),0);
            return json_encode($return);

          }
          else{
            $edited = Request::get('student');

            //name ar
            $first_name_en = $edited['first_name_en'];
            $middle_name_en = $edited['middle_name_en'];
            $last_name_en =  $edited['last_name_en'];

            //name ar
            $first_name_ar = $edited['first_name_ar'];
            $middle_name_ar = $edited['middle_name_ar'];
            $last_name_ar =  $edited['last_name_ar'];

            //official_id
            $official_id_type = $edited['official_id_type'];
            $official_id_number = $edited['official_id_number'];
            $nationality = $edited['nationality'];

            $gender = $edited['gender'];
            $tongue = $edited['mother_tongue'];

            $class_id =$edited['class_id'];

            $address_en = $edited['home_address_en'];
            $address_ar = $edited['home_address_ar'];

            $disability_id  = $edited['disability_id'];
            if($disability_id == 0) $disability_id = null;
            $school_id = $edited['school_id'];

            //update official id table
            $official_id = $std->official_id;
            DB::table('identification')->where('official_id', '=', $official_id)
                                      ->update(array(
                                        'official_id_type' => $official_id_type,
                                        'official_id_number' => $official_id_number,
                                        'nationality' => $nationality
                                      ));
            //update the medical info table
            $medical_info_id = $std->medical_info_id;
            DB::table('medical_info')->where('medical_info_id', '=', $medical_info_id)
                                    ->update(array(
                                      'disability_id' => $disability_id
                                    ));
            //update student table
            DB::table('student')->where('first_name_en', '=', $first_name_en)
                                      ->where('middle_name_en', '=', $middle_name_en)
                                      ->where('last_name_en', '=', $last_name_en)
                                      ->where('date_of_birth', '=', $date_of_birth)
                                      ->update(array(
                                        'school_id' => $school_id,
                                        'first_name_en' => $first_name_en,
                                        'middle_name_en' => $middle_name_en,
                                        'last_name_en' => $last_name_en,
                                        'first_name_ar' => $first_name_ar,
                                        'middle_name_ar' => $middle_name_ar,
                                        'last_name_ar' => $last_name_ar,

                                        'gender' => $gender,
                                        'mother_tongue' => $tongue,

                                        'date_of_birth' => $date_of_birth,

                                        'home_address_en' => $address_en,
                                        'home_address_ar' => $address_ar,

                                        'class_id' => $class_id,
                                        'updated_at' => date("y-m-d h:i:sa")
                                        ));

              $return = new stdClass;
              $return->status = 200;

              $response = new stdClass;
              $response->status = 1;
              $response->error = "Student edited successfully";

              $return->response = $response;
              error_log(json_encode($return),0);
              return json_encode($return);

            }
        }
      }
  }

  private function Verfiy_User($username,$password){
      $user = DB::table('users')->where('email', '=', $username)->first();
      if(is_null($user)){
        return false;
      }

      if($user->password != $password){
        return false;

      }

      else return $user;
  }

  private function GetSchoolAdmins($timestamp){
      $user = DB::table('users')->where('updated_at', '>' , $timestamp)->first();
      if(!is_null($user)){
        $NewUpdatedData = DB::table('users')->select(
            'id as Id',
            'user_first_name as first_name',
            'user_last_name as last_name',
            'email as email',
            'password',
            'school_id as school_id'
            )
        ->whereNotNull('school_id')
        ->where('is_deleted', 0)
        ->orderBy('school_id','asc')
        ->orderBy('user_first_name','asc')
        ->orderBy('user_last_name','asc')
        ->get();
      }
      else{
        $NewUpdatedData = array();
      }
      return $NewUpdatedData;
  }

  private function GetClasses($timestamp){
      $user = DB::table('class')->where('updated_at', '>' , $timestamp)->first();
      if(!is_null($user)){
        $NewUpdatedData = DB::table('class')->select(
            'class_id',
            'school_id',
            'grade',
            'section',
            'class_name'
            )
        ->where('is_deleted', 0)
        ->orderBy('class_name','asc')
        ->get();
      }
      else{
        $NewUpdatedData = array();
      }
      return $NewUpdatedData;
  }

  private function GetStudents($timestamp){
      $user = DB::table('student')->where('updated_at', '>' , $timestamp)->first();
      if(!is_null($user)){
        $NewUpdatedData = DB::table('student')->select(
            'student_id',
            'student_number',
            'official_id',
            'school_id',
            'first_name_en as first_name',
            'middle_name_en as middle_name',
            'last_name_en as last_name',
            'gender',
            'mother_tongue',
            'medical_info_id',
            'home_address_en as address',
            'date_of_birth',
            'class_id',
            'active'
            )
        ->where('is_deleted', 0)
        ->orderBy('school_id','asc')
        ->orderBy('last_name_en')
        ->orderBy('first_name_en')
        ->get();
      }
      else{
        $NewUpdatedData = array();
      }
      return $NewUpdatedData;
  }

  private function GetOfficialIds($timestamp){
      $user = DB::table('identification')->where('updated_at', '>' , $timestamp)->first();
      if(!is_null($user)){
        $NewUpdatedData = DB::table('identification')->select(
            'official_id_type',
            'official_id_number',
            'nationality'
            )
        ->where('is_deleted', 0)
        ->orderBy('official_id_type','asc')
        ->orderBy('official_id_number','asc')
        ->get();
      }
      else{
        $NewUpdatedData = array();
      }
      return $NewUpdatedData;
  }

  private function GetMedicalInfos($timestamp){
      $user = DB::table('medical_info')->where('updated_at', '>' , $timestamp)->first();
      if(!is_null($user)){
        $NewUpdatedData = DB::table('medical_info')->select(
            'medical_info_id',
            'disability_id',
            'details'
            )
        ->where('is_deleted', 0)
        ->get();
      }
      else{
        $NewUpdatedData = array();
      }
      return $NewUpdatedData;
  }

  private function GetDisabilityInfo($timestamp){
    $user = DB::table('disabilities')->where('updated_at', '>' , $timestamp)->first();
    if(!is_null($user)){
      $NewUpdatedData = DB::table('disabilities')->select(
          'disability_id',
          'disability_type'
          )
      ->where('is_deleted', 0)
      ->get();
    }
    else{
      $NewUpdatedData = array();
    }
    return $NewUpdatedData;
  }
}
