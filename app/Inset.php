<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inset extends Model
{
    public function articleGroups(){
        return $this->hasMany(Article::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'amount' => 'integer',
        'code' => 'string',
        'color' => 'string',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
    ];
}
