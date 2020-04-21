<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalletLabelWeightCheck extends Model
{


    protected $casts = [
        'id' => 'integer',
        'expected_weight' => 'integer',
        'actual_weight' => 'integer',
        'percentage' => 'float',
        'valid' => 'boolean',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'pallet_label_id'=>'integer',
    ];

}
