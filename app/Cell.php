<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cell extends Model
{
    use SoftDeletes;

    public function Farmer(){
        return $this->belongsTo(Farmer::class);
    }
    public function cultivationCycles(){
        return $this->hasMany(CultivationCycle::class);
    }
}
