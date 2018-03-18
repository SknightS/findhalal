<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderitems extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'orderItemId';
    protected $table = 'orderitem';
}
