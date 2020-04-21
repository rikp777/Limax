<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanningAmount extends Model
{
    public function Planning()
    {
        return $this->belongsTo(Planning::class);
    }

    protected $casts = [
        'id' => 'integer',
        'planning_id' => 'integer',
        'sort_type_id' => 'integer',
        'amount' => 'integer',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
    ];
}
