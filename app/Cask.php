<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cask extends Model
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
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'created_at'=>'datetime',
        'updated_at'=>'datetime',
        'deleted_at' =>'datetime',
    ];
}
