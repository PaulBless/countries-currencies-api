<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    protected $table = "tbl_currencies";
    public $timestamps = false;

    protected $fillable = [
        'iso_code',
        'iso_numeric_code',
        'common_name',
        'official_name',
        'symbol',
    ];
}
