<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanningAmount extends Model
{
    public function Planning()
    {
        return $this->belongsTo(Planning::class);
    }
}
