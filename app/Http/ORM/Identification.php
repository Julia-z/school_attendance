<?php

namespace app\Http\ORM;

use Eloquent;
class Identification extends Eloquent
{
    //
    protected $table = "identification";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'official_id', 'official_id_type', 'official_id_number', 'nationality'

    ];

}
