<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'zipcodeId';
    protected $table = 'zipcode';
}
