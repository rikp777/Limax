<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farmer extends Model
{
    use SoftDeletes;


    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function cells()
    {
        return $this->hasMany(Cell::class);
    }
    public function cultivationCycles()
    {
        return $this->hasMany(CultivationCycle::class);
    }
    public function palletlabels()
    {
        return $this->hasMany(PalletLabel::class);
    }



    public static function getCurrentFarmer(){
        return Farmer::find(1);
    }
}
