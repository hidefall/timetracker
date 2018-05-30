<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','role','company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id');
    }

    public function clients(){
        return $this->hasMany(Client::class,'user_id','id');
    }

    public function company_owns(){
        return $this->hasOne(Company::class,'id','company_id');
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function projects(){
        return $this->hasMany(Project::class,'user_id','id');
    }

    public function tasks(){
        return $this->hasMany(Task::class,'user_id','id');
    }

    public function timeframes(){
        return $this->hasMany(TimeFrame::class,'user_id','id');
    }
}
