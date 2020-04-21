<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function farmers()
    {
        return $this->belongsToMany(Farmer::class);
    }
    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }




    public function is($roleName)
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == $roleName) {
                return true;
            }
        }
        return false;
    }




    public function isAdmin()
    {
        return $this->is('Admin');
    }

    public function isModerator()
    {
        return $this->is('Moderator');
    }

    public function isFarmer()
    {
        return $this->is('Farmer');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'uid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    protected $casts = [
        'id' => 'integer',
        'uid' => 'string',
        'first_name' => 'string',
        'insert_name' => 'string',
        'last_name' => 'string',
        'photo' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'color_blind' => 'boolean',
        'remember_token' => 'string',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
    ];
}
