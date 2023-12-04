<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $table = 'todo';
    protected $fillable = ['todo','category','user_id','managers','description','viecdagiao','viectredeadline','vieckhongdat','chopheduyet','tongsodauviec'];
    public function taskDetail()
    {
        return $this->hasMany('App\Model\TaskDetail','id_todo','id');
    }
}
