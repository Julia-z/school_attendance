<?php

namespace app\Http\ORM;

use Eloquent;
class Student extends Eloquent
{
    //
    protected $table = "student";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'official_id',
        'first_name_en', 'middle_name_en', 'last_name_en',
        'first_name_ar', 'middle_name_ar', 'last_name_ar',
        'passport_number', 'UNRWA_id_card',
        'gender', 'mother_tongue', 'nationality',
        'date_of_birth', 'class_id', 'active',
        'home_address_ar', 'home_address_en', 'medical_info_id'

    ];

}
