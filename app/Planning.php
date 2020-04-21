<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    public function PlanningAmount()
    {
        return $this->belongsToMany(PlanningAmount::class);
    }

    protected $dates = ['date'];

    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'cell_id' => 'integer',
        'farmer_id' => 'integer',
        'status_id' => 'integer',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
    ];
}
