<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function cells()
    {
        return $this->hasMany('App\Cell');
    }
    public function cultivationCycles()
    {
        return $this->hasMany('App\CultivationCycle');
    }
    public function palletlabels()
    {
        return $this->hasMany('App\Palletlabel')
            ->orderBy('created_at', 'desc')
            ->take(5);
    }
    public static function getCurrentFarmer(){
        return Farmer::find(1);
    }
}
