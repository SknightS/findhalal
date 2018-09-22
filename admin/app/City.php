<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'cityId';
    protected $table = 'city';
}
