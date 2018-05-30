<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function timeframes(){
        return $this->hasMany(TimeFrame::class,'task_id','id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }
}
