<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskDetailLog extends Model
{
    //
    protected $table = 'task_detail_log';
    protected $fillable = ['id_task_detail','id_user','description','date','type'];
}
