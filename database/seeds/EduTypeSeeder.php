<?php

use Illuminate\Database\Seeder;

class EduTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edu_types')->insert([
            [
                'name_ar' => 'أهلى',
                'name_en' => 'Private',
            ],
            [
                'name_ar' => 'أجنبى',
                'name_en' => 'International',
            ],
            [
                'name_ar' => 'دبلومة',
                'name_en' => 'Diploma',
            ],
            [
                'name_ar' => 'أخرى',
                'name_en' => 'Other',
            ],
        ]);
    }
}
