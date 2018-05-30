<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeFrame extends Model
{
    protected $fillable = ['user_id','task_id','description','timer_started','timer_finished','billable','price_per_hour'];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function task(){
        return $this->belongsTo(Task::class,'task_id','id')->with('project');
    }
}
