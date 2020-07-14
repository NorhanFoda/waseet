<?php

use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goals')->insert([
            [
                'title_ar' => 'الهدف من (البحث عن عمل)',
                'title_en' => 'Goal of (Search for Job)',
                'text_ar' => 'لتسهيل عملية البحث عن الوظائف المتاحة',
                'text_en' => 'To facilitate the search for available jobs',
                'static_page_id' => 1
            ],
            [
                'title_ar' => 'الهدف من (المعلم الخصوصى)',
                'title_en' => 'Goal of (Private Teachers)',
                'text_ar' => 'لخلق منصة عمل لخريجات الأقسام التربوية و الإستفادة من خبراتهم التعليمية و كفائتهم',
                'text_en' => 'To create a work platform for female graduates of educational departments and to benefit from their educational experiences and competence',
                'static_page_id' => 1
            ],
            [
                'title_en' => 'Goal of (Educational Bags)',
                'title_ar' => 'الهدف من(الحقائب التعليمية)',
                'text_en' => 'Help the teacher in introducing educational material in interesting ways for students',
                'text_ar' => 'لتساعد المعلم فى طرح المادة التعليمية بطرق مشوقة للطلاب',
                'static_page_id' => 1
            ],
        ]);
    }
}
