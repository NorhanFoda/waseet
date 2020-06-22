<?php

use Illuminate\Database\Seeder;

class StagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stages')->insert([
            [
                'name_ar' => 'الأولى',
                'name_en' => 'First',
            ],
            [
                'name_ar' => 'الثانية',
                'name_en' => 'Second',
            ],
            [
                'name_ar' => 'االثالثة',
                'name_en' => 'Third',
            ],
        ]);
    }
}
