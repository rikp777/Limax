<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
