<?php

use Illuminate\Database\Seeder;

class specializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->insert([
            [
                'name_ar' => 'تدريس',
                'name_en' => 'Teaching',
            ],
            [
                'name_ar' => 'إدارى',
                'name_en' => 'Administrative',
            ],
            [
                'name_ar' => 'أخرى',
                'name_en' => 'Other',
            ],
        ]);
    }
}
