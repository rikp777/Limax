<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    public function Farmer(){
        return $this->belongsTo(Farmer::class);
    }
    public function cultivationCycles(){
        return $this->hasMany(CultivationCycle::class);
    }
}
