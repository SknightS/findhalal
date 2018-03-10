<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'customerId';
    protected $table = 'customer';
}
