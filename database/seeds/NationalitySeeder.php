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
                'name_ar' => 'سعودى',
                'name_en' => 'Saudi',
            ],
            [
                'name_ar' => 'مصرى',
                'name_en' => 'Egyption',
            ],
            [
                'name_ar' => 'أخرى',
                'name_en' => 'Other',
            ],
        ]);
    }
}
