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

    protected $casts = [
        'id' => 'integer',
        'cell_description' => 'string',
        'fill_date' => 'date',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'cell_id'=>'integer',
        'farmer_id'=>'integer',
        'article_group_id'=>'integer',
    ];

}
