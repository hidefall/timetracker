<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

class Profile extends Model
{

    use EloquentImageMutatorTrait;
    
    protected $fillable = ['firstname','lastname','user_id','phone','address','image'];

    protected $image_fields = ['image'];
}
