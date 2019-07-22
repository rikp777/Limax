<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortType extends Model
{
    public function articleGroups(){
        return $this->hasMany(Article::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
