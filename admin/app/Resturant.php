<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resturant extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'resturantId';
    protected $table = 'resturant';
}
