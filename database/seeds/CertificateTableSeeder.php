<?php

use Illuminate\Database\Seeder;
use App\Certificate;

class CertificateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificates = [
            [
                'name' => 'Fair Produce'
            ],
            [
                'name' => 'GLOBALG.A.P.'
            ],
            [
                'name' => 'Skal'
            ],
            [
                'name' => 'Milieukeur'
            ],
        ];
        Certificate::insert($certificates);
    }
}
