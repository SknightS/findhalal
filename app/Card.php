<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Card extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'cardId';
    protected $table = 'card';
}
