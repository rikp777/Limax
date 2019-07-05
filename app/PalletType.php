<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalletType extends Model
{
    public function articleGroups(){
        return $this->hasMany(Article::class);
    }
}
