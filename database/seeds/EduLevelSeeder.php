<?php

use Illuminate\Database\Seeder;

class EduLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edu_levels')->insert([
            [
                'name_ar' => 'بكالوريوس',
                'name_en' => 'Bachelor',
            ],
            [
                'name_ar' => 'ماجستير',
                'name_en' => 'Master',
            ],
            [
                'name_ar' => 'دكتوراه',
                'name_en' => 'Doctorate',
            ],
            [
                'name_ar' => 'أخرى',
                'name_en' => 'Other',
            ],
        ]);
    }
}
