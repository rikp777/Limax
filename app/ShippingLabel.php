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
}
