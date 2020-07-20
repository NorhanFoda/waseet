<?php

use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
                'name_ar' => 'فيزا',
                'name_en' => 'VISA',
            ],
            [
                'name_ar' => 'ماستر كارد',
                'name_en' => 'MASTER',
            ],
            [
                'name_ar' => 'مدى',
                'name_en' => 'MADA',
            ],
        ]);
    }
}
