<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    protected $hidden = [
        'updated_at',
        'created_at',
        'pivot'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'color' => 'string',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
    ];
}
