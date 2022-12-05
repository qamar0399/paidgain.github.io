<?php

namespace Database\Seeders;

use App\Models\Deposit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deposits = [
            ['id' => 1, 'user_id' => 2, 'getway_id' => 3, 'trx' => 'tr_YomfGrhvVX', 'amount' => 100, 'totalamount' => 1002, 'currency' => 'usd', 'status' => 1, 'payment_status' => 1, 'charge' => 2, 'rate' => 10, 'created_at' => now()->subMonth(), 'updated_at' => now()->subMonth()],
            ['id' => 2, 'user_id' => 2, 'getway_id' => 3, 'trx' => 'tr_8vwbd98R2r', 'amount' => 200, 'totalamount' => 2002, 'currency' => 'usd', 'status' => 1, 'payment_status' => 1, 'charge' => 2, 'rate' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'user_id' => 2, 'getway_id' => 3, 'trx' => 'tr_ebf4z38A4a', 'amount' => 100, 'totalamount' => 1002, 'currency' => 'usd', 'status' => 1, 'payment_status' => 1, 'charge' => 2, 'rate' => 10, 'created_at' => now()->subMonths(2), 'updated_at' => now()->subMonths(2)],
            ['id' => 4, 'user_id' => 2, 'getway_id' => 3, 'trx' => 'tr_ebf4z38A40', 'amount' => 500, 'totalamount' => 5002, 'currency' => 'usd', 'status' => 1, 'payment_status' => 1, 'charge' => 2, 'rate' => 10, 'created_at' => now()->subMonth(), 'updated_at' => now()->subMonth(),],
            ['id' => 5, 'user_id' => 2, 'getway_id' => 3, 'trx' => 'tr_ebf4z00A40', 'amount' => 100, 'totalamount' => 1002, 'currency' => 'usd', 'status' => 1, 'payment_status' => 1, 'charge' => 2, 'rate' => 10, 'created_at' => now(), 'updated_at' => now()],
        ];

        Deposit::insert($deposits);
    }
}
