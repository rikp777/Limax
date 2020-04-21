<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateFarmerCode extends Model
{
    public function Farmer(){
        return $this->belongsTo(Farmer::class);
    }
    public function Certificate(){
        return $this->belongsTo(Certificate::class);
    }

    protected $casts = [
        'certificate_id' => 'integer',
        'farmer_id' => 'integer',
        'code' => 'string',
    ];
}
