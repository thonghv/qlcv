<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskDetailReport extends Model
{
    //
    protected $table = 'task_detail_report';
    protected $fillable = ['id_task_detail','id_user','comment_report','date_report','id_user_reject','comment_reject','date_reject'];
    public function taskDetailFile()
    {
        return $this->hasMany('App\Model\TaskDetailFile','id_detail_report','id');
    }
}
