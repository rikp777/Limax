<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortType extends Model
{
    public function articleGroups(){
        return $this->hasMany(Article::class);
    }
}
