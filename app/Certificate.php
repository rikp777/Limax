<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function certificateFarmerCode()
    {
        return $this->hasMany(CertificateFarmerCode::class);
    }

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'created_at'=>'datetime',
        'updated_at'=>'datetime',
    ];
}
