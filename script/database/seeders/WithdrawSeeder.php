<?php

namespace Database\Seeders;

use App\Models\Withdraw;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $withdraws = [
            ['id' => 1, 'withdraw_method_id' => 1, 'user_id' => 2, 'amount' => 100, 'charge' => 2, 'rate' => 1, 'currency' => 'USD', 'commant' => NULL, 'status' => 'pending', 'created_at' => now()->subMonths(3), 'updated_at' => now()->subMonths(3)],
            ['id' => 2, 'withdraw_method_id' => 1, 'user_id' => 2, 'amount' => 150, 'charge' => 2, 'rate' => 1, 'currency' => 'USD', 'commant' => NULL, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'withdraw_method_id' => 1, 'user_id' => 2, 'amount' => 300, 'charge' => 2, 'rate' => 1, 'currency' => 'USD', 'commant' => NULL, 'status' => 'approved', 'created_at' => now()->subMonth(), 'updated_at' => now()->subMonth()],
        ];

        Withdraw::insert($withdraws);
    }
}
