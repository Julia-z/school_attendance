<?php

namespace app\Http\ORM;

use Eloquent;
class Guardian extends Eloquent
{
    //
    protected $table = "family_member";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'guardian_id',
        'first_name_en', 'last_name_en',
        'first_name_ar', 'last_name_ar',
        'phone',
        'relationship_id', 'send_sms_to',
        'address_ar', 'address_en',

    ];

}
