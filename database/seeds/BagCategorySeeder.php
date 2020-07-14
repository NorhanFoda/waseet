<?php

use Illuminate\Database\Seeder;

class BagCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bag_categories')->insert([
            [
                'name_ar' => 'معلم الصف',
                'name_en' => 'Class teacher',
            ],
            [
                'name_ar' => 'الأيام العالمية',
                'name_en' => 'Universal days',
            ],
            [
                'name_ar' => 'رياضيات',
                'name_en' => 'Math',
            ],
            [
                'name_ar' => 'لغتى',
                'name_en' => 'My language',
            ],
            [
                'name_ar' => 'ألعاب',
                'name_en' => 'Games',
            ],
            [
                'name_ar' => 'شروحات',
                'name_en' => 'Explanations',
            ],
            [
                'name_ar' => 'باور بوينت',
                'name_en' => 'PowerPoint',
            ],
        ]);
    }
}
