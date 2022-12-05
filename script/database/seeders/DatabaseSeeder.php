<?php

namespace Database\Seeders;

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
       $this->call([
        PlanSeeder::class,
        UsertableSeeder::class,
        OptionTableSeeder::class,
        PaymentGatewaySeeder::class,
        CategorySeeder::class,
        CategoryMetaSeeder::class,
        WebsiteSeeder::class,
        
        TermSeeder::class,
        TermMetaSeeder::class,
        MenuSeeder::class,
        

        PTCAdvertisementSeeder::class,
        PTCAdvertisementMetaSeeder::class,

       // DepositSeeder::class,
        WithdrawMethodSeeder::class,
        MediaSeeder::class,
       // WithdrawSeeder::class,
        
    ]);
    }
}
