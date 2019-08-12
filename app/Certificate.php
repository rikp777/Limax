<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function certificateFarmerCode()
    {
        return $this->hasMany(CertificateFarmerCode::class);
    }
}
