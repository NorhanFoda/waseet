<?php

use Illuminate\Database\Seeder;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert([
            [
                'name_ar' => 'اللغة العربية',
                'name_en' => 'Arabic language',
            ],
            [
                'name_ar' => 'الرياضيات',
                'name_en' => 'Math',
            ],
            [
                'name_ar' => 'العلوم',
                'name_en' => 'Science',
            ],
        ]);
    }
}
