<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name','user_id','estimation','client_id','status'];

    public function tasks(){
        return $this->hasMany(Task::class,'project_id','id')->with('timeframes');
    }
}
