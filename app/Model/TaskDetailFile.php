<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskDetailFile extends Model
{
    //
    protected $table = 'task_detail_file';
    protected $fillable = ['id_task_detail','id_detail_report','id_user','comment','name_file','file'];
}
