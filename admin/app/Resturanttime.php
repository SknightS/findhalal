<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resturanttime extends Model
{
    //resturanttime
    public $timestamps = false;
    protected $primaryKey = 'resturanttimeId';
    protected $table = 'resturanttime';
}
