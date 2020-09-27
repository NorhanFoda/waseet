<?php

use Illuminate\Database\Seeder;

class BankReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_receipts')->insert([
            [
                'user_id' => 1,
                'bank_id' => 1,
                'name' => 'jadara',
                'email' => 'admin@jaadara.com',
                'phone' => '+966563793461',
                'cost' => 10
            ],
        ]);
    }
}
