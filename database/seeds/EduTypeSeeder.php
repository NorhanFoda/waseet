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
                'type_ar' => 'أهلى',
                'type_en' => 'Private',
            ],
            [
                'type_ar' => 'أجنبى',
                'type_en' => 'International',
            ],
            [
                'type_ar' => 'دبلومة',
                'type_en' => 'Diploma',
            ],
        ]);
    }
}
