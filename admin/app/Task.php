<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'taskId';
    protected $table = 'task';

    public function user()
    {
        return $this->belongsTo(User::class,'userId','userId');
    }
}
