<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'purchaseId';
    protected $table = 'purchase';
}
