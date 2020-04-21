<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingLabel extends Model
{
    use SoftDeletes;

    public function palletLabels(){
        return $this->belongsToMany(PalletLabel::class);
    }

    protected $casts = [
        'id' => 'integer',
        'transport_date' => 'date',
        'transport_delivery_date' => 'date',
        'transport_driver' => 'integer',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
        'user_id' => 'integer',
        'status_id' => 'integer',
        'farmer_id' => 'integer',
        'truck_id' => 'integer',
        'transport_driver_user_id' => 'integer',
    ];
}
