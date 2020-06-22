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
                'level_ar' => 'بكالوريوس',
                'level_en' => 'Bachelor',
            ],
            [
                'level_ar' => 'ماجستير',
                'level_en' => 'Master',
            ],
            [
                'level_ar' => 'دكتوراه',
                'level_en' => 'Doctorate',
            ],
        ]);
    }
}
