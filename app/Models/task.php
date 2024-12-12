<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    //
    protected $primaryKey = 'task_id';
    protected $fillable = [
        'task_title',
        'task_description',
        'task_status',
        'user_id',
    ];
}
