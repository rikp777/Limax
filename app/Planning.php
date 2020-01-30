<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    public function PlanningAmount()
    {
        return $this->belongsToMany(PlanningAmount::class);
    }
}
