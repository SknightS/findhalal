<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemsize extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'itemsizeId';
    protected $table = 'itemsize';
}
