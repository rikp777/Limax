<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cask extends Model
{
    public function articleGroups(){
        return $this->hasMany(Article::class);
    }
}
