<?php

use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            [
                'name_ar' => 'مصرف الراجحى',
                'name_en' => 'Al Rajhi Bank',
                'account_number' => '546445132132464651',
                'iban' => '85464952115415454'
            ],
        ]);
    }
}
