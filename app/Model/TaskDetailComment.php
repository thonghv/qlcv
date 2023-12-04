<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskDetailComment extends Model
{
    //
    protected $table = 'task_detail_comment';
    protected $fillable = ['id_task_detail','id_user','comment','type','date_comment'];
}
