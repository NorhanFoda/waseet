<?php

use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->insert([
            [
                'name_ar' => 'Saudi',
                'name_en' => 'سعودى',
            ],
            [
                'name_ar' => 'Egyption',
                'name_en' => 'مصرى',
            ],
        ]);
    }
}
