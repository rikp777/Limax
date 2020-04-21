<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalletType extends Model
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
        'weight' => 'string',
//        'price' => 'decimal(8, 2)',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
    ];
}
