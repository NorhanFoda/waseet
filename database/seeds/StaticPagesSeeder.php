<?php

use Illuminate\Database\Seeder;

class StaticPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('static_pages')->insert([
            [
                'name_ar' => 'من نحن',
                'name_en' => 'About us',
                'short_description_ar' => 'الوصف المختصر',
                'short_description_en' => 'Short description',
                'full_description_ar' => 'الوصف الكامل',
                'full_description_en' => 'Full description',
                'appear_in_footer' => 1,
            ],
            [
                'name_ar' => 'سياسة الخصوصية',
                'name_en' => 'Privacy and policy',
                'short_description_ar' => 'الوصف المختصر',
                'short_description_en' => 'Short description',
                'full_description_ar' => 'الوصف الكامل',
                'full_description_en' => 'Full description',
                'appear_in_footer' => 1,
            ],
            [
                'name_ar' => 'الشروط و الأحكام',
                'name_en' => 'Rules and conditions',
                'short_description_ar' => 'الوصف المختصر',
                'short_description_en' => 'Short description',
                'full_description_ar' => 'الوصف الكامل',
                'full_description_en' => 'Full description',
                'appear_in_footer' => 1,
            ],
            [
                'name_ar' => 'مركز المساعدة',
                'name_en' => 'Help center',
                'short_description_ar' => 'الوصف المختصر',
                'short_description_en' => 'Short description',
                'full_description_ar' => 'الوصف الكامل',
                'full_description_en' => 'Full description',
                'appear_in_footer' => 1,
            ],
        ]);
    }
}
