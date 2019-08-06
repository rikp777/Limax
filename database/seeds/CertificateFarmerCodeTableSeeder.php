<?php

use Illuminate\Database\Seeder;
use App\CertificateFarmerCode;

class CertificateFarmerCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificateFarmerCodes = [
            [
                'certificate_id' => '1',
                'farmer_id' => '2',
                'code' => 'asldjfaskf'
            ],
            [
                'certificate_id' => '2',
                'farmer_id' => '2',
                'code' => '123456789IA'
            ],
            [
                'certificate_id' => '3',
                'farmer_id' => '2',
                'code' => '5749823754OT'
            ],
            [
                'certificate_id' => '4',
                'farmer_id' => '2',
                'code' => '28375LJSDG'
            ],
            [
                'certificate_id' => '2',
                'farmer_id' => '1',
                'code' => 'KJASDF2Y3Y23S'
            ],
            [
                'certificate_id' => '4',
                'farmer_id' => '1',
                'code' => '98765432QW'
            ],
        ];
        CertificateFarmerCode::insert($certificateFarmerCodes);
    }
}
