<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'color' => 'string',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
    ];
}
