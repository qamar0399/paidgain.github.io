<?php

namespace Database\Seeders;

use App\Models\WithdrawMethod;
use Illuminate\Database\Seeder;

class WithdrawMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            ['id' => 1, 'name' => 'gPay', 'image' => '/uploads/1/22/05/628b0d841309a2305221653280132small.png', 'min_limit' => 100, 'max_limit' => 1000, 'delay' => '3', 'fixed_charge' => NULL, 'rate' => 1, 'percent_charge' => 2, 'currency' => 'USD', 'user_data' => NULL, 'instruction' => '<p>Instruction goes here<br></p>', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];

        WithdrawMethod::insert($methods);
    }
}
