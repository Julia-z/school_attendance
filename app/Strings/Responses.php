<?php

namespace app\Strings;

class Responses {

    public static


    public static $username = "User Name";
    public static $password = "Password";
    public static $json_object = "Received Json Format";
    //Input Fiels
    public static $inputUsername = "username";
    public static $inputPassword = "password";
    public static $inputObjects = "jsonObject";
    public static $inputType = "type";
    public static $inputTimestamp = "timestamp";
    public static $inputCommentId = "Comment";
    public static $inputTruckId = "Truck";
    //Error Messages
    public static $Wrong_Credentials = "Wrong Credentials";
    public static $missing_input_fields = "Missing Input Fields";
    public static $Incompatible_access = "Incompatible Access Level";
    public static $Json_decoding_error = "An error occured while decoding Json Object";
    public static $gps_info_missing = "Some info are Missing from the GPSLog with id: ";
    public static $me_info_missing = "Some info are Missing from the Emptying Measurement with id: ";
    public static $m_info_missing = "Some info are Missing from the Measurement with id: ";
    public static $f_info_missing = "Some info are Missing from the Full Tank with id: ";
    public static $c_info_missing = "Some info are Missing from the Comment with id: ";
    public static $pip_entrance_info_missing = "Some info are Missing from the PIP Entrance Log with id: ";
    public static $cen_info_missing = "Some info are Missing from the Camp Entrance Log with id: ";
    public static $cex_info_missing = "Some info are Missing from the Camp Exit Log with id: ";
    public static $object_projection = "An error occured while handling Json";
    public static $ua_info_missing = "Some info are Missing from the User Activity Log with id: ";
    public static $pex_info_missing = "Some info are Missing from the Camp Exit Log with id : " ;
    public static $unrecognized_type = "An unrecognized type was received";
    //Input Types
    public static $measurmet_log = "MeasurementLog";
    public static $location_log = "LocationLog";
    public static $measurmet_e_log = "MeasurementEmptyingLog";
    public static $is_full_log = "IsFullLog";
    public static $comment_log = "CommentLog";
    public static $pip_entrance = "PIPEntrance";
    public static $empty_tank = "EmptyingTank";

    public static $add_measurement = "AddMeasurement";

    public static $get_users = "Users";
    public static $get_tanks = "Tanks";
    public static $get_remaining_trucks = "GetRemainingTrucks";
    public static $get_z_remaining_trucks = "GetPlantRemainingTrucks";
    public static $get_trucks = "Trucks";
    public static $get_inside_tanks = "InsideTanks";
    public static $get_outside_tanks = "OutsideTanks";
    public static $get_inbound_trucks = "InboundTrucks";
    public static $get_daily_records = "GetDailyRecords";

    public static $camp_entrance = "CampEntrance";
    public static $camp_exit = "CampExit";

    public static $plant_entrance = "PlantEntrance";
    public static $plant_exit = "PlantExit";


    public static $user_activity = "UserUsage";
    public static $get_destinations = "Destinations";
    //public static $comment_log= "CommentLog";
    public static $get_comment = "Comment";
    public static $get_tasks = "Tasks";
    public static $get_new_tasks = "NewTasks";
    public static $inputCurrentBatch = "Batch";
    public static $get_daily_logs = "GetDailyLogs";
    public static $event_id_used_elsewhere = "Event Id belongs to an event of different type";
    //public static String $Wrong_Credentials = "Wrong Credentials";
    //public static String $Wrong_Credentials = "Wrong Credentials";
    public static $get_buildings_tanks = "GetBuildingsTanks";
    public static $get_buildings_tanks2 = "BuildingsTanks";
    public static $add_record = "AddRecord";
    public static $add_record2 = "HotlineRecord";
    public static $app_id = "AddAppId";
    public static $verifiy_record = "VerifyRecord";

    public static $error_occured = "An Error has Occured";

    public static $get_districts = "GetDistricts";
    public static $get_blocks = "GetBlocks";
}
