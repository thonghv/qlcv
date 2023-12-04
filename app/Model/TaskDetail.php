<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskDetail extends Model
{
    //
    protected $table = 'task_detail';
    protected $fillable = ['id_task','title','content_task','status','count_retask','deadline','id_user_create','date_create','is_read', 'is_kpi'];

    public function taskDetailReport()
    {
        return $this->hasMany('App\Model\TaskDetailReport','id_task_detail','id');
    }
    public function taskDetailFile()
    {
        return $this->hasMany('App\Model\TaskDetailFile','id_task_detail','id');
    }
    public function taskDetailComment()
    {
        return $this->hasMany('App\Model\TaskDetailComment','id_task_detail','id');
    }
    public function taskDetailLog()
    {
        return $this->hasMany('App\Model\TaskDetailLog','id_task_detail','id');
    }
}
