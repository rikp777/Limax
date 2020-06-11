<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortType extends Model
{
    public function articleGroups(){
        return $this->hasMany(Article::class);
    }
    public function farmers()
    {
        return $this->belongsToMany(Farmer::class);
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
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
    ];
}
