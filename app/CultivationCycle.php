<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CultivationCycle extends Model
{
    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }
    public function cell(){
        return $this->belongsTo(Cell::class);
    }
    public function articleGroup(){
        return $this->belongsTo(ArticleGroup::class);
    }
    public function palletLabels(){
        return $this->hasMany(PalletLabel::class);
    }
    public function cultivationCycleFlights(){
        return $this->hasMany(CultivationCycleFlight::class);
    }

}
