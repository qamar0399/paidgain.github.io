<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            ['id' => '1', 'commission_rate' => '1', 'name' => 'Free', 'price' => '0', 'ad_limit' => '3', 'status' => '1', 'days' => '-1', 'is_trial' => '0', 'data' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '2', 'commission_rate' => '2', 'name' => 'Starter', 'price' => '10', 'ad_limit' => '10', 'status' => '1', 'days' => '30', 'is_trial' => '0', 'data' => NULL, 'created_at' => now(), 'updated_at' => now()],
        ];
        Plan::insert($plans);
    }

}

