<?php

namespace app\Http\ORM;

use Eloquent;
class MedicalInfo extends Eloquent
{
    //
    protected $table = "medical_info";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'medical_info_id', 'medical_info_desc'
    ];

}
