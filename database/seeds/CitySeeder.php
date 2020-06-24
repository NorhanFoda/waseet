<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'name_ar' => 'جدة',
                'name_en' => 'Jedda',
                'country_id' => 1,
            ],
            [
                'name_ar' => 'القاهرة',
                'name_en' => 'Cairo',
                'country_id' => 2,
            ],
        ]);
    }
}
