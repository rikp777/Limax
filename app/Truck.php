<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'id' => 'integer',
        'license_plate' => 'string',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'status_id'=>'integer',
        'user_id'=>'integer',
    ];
}
