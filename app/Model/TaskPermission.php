<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskPermission extends Model
{
    //
    protected $table = 'task_permission';
    protected $fillable = ['id_task','id_user','permission'];
}
