<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function timeframes(){
       return $this->belongsToMany(TimeFrame::class);
    }
}
