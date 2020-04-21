<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CultivationCycleFlight extends Model
{
    public function Cultivation(){
        return $this->belongsTo(CultivationCycle::class);
    }

    protected $fillable = [
        'date',
        'cultivation_cycle_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'cultivation_cycle_id'=>'integer',
    ];
}
