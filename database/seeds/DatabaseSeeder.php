<?php

use App\Farmer;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RoleTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(ArticleGroupTableSeeder::class);
        $this->call(UserTableSeeder::class);


        $this->call(PalletTypeSeeder::class);
        $this->call(CaskTableSeeder::class);
        $this->call(InsetTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(SortTypeTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(FarmerTableSeeder::class);





        $this->call(CellTableSeeder::class);
        $this->call(CertificateTableSeeder::class);
        $this->call(CertificateFarmerCodeTableSeeder::class);
        $this->call(CultivationCycleTableSeeder::class);
        $this->call(CultivationCycleFlightTableSeeder::class);

        $this->call(PalletlabelTableSeeder::class);
        $this->call(TruckTableSeeder::class);


        User::findOrFail(1)->farmers()->sync( [ 1, 2 ] );
        $farmers = Farmer::all();
        User::where('id', '>', '1')->each(function ($user) use ($farmers) {
            $user->farmers()->attach(
                $farmers->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
