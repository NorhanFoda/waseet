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
                'vision_ar' => 'التميز و الإحترافية فى تقديم الخدمات للباحثين عن الوظائف التعليمية',
                'vision_en' => 'Excellence and professionalism in providing services to those looking for educational jobs',
                'message_ar' => 'نسعى لتقديم الخبارات المتعددة من الوظائف التعليمية عبر بوابة تقنية بمعايير عالمية لنكون الوسيط بين الباحثين عن العمل و المنشآت التعليمية للإستفادة من الخبرات و الكفاءات, كما نقوم بتقديم عدد من الحقائب التعليمية لتساعدالمعلم فى تطوير مهاراتة التعليمية',
                'message_en' => 'We seek to provide multiple experiences of educational jobs through a technical portal with international standards to be the mediator between job seekers and educational facilities to take advantage of expertise and competencies, and we provide a number of educational bags to help the teacher in developing his educational skills',
            ],
            [
                'name_ar' => 'سياسة الخصوصية',
                'name_en' => 'Privacy and policy',
                'short_description_ar' => 'الوصف المختصر',
                'short_description_en' => 'Short description',
                'full_description_ar' => 'الوصف الكامل',
                'full_description_en' => 'Full description',
                'appear_in_footer' => 1,
                'vision_ar' => null,
                'vision_en' => null,
                'message_ar' => null,
                'message_en' => null,
            ],
            [
                'name_ar' => 'الشروط و الأحكام',
                'name_en' => 'Rules and conditions',
                'short_description_ar' => 'الوصف المختصر',
                'short_description_en' => 'Short description',
                'full_description_ar' => 'الوصف الكامل',
                'full_description_en' => 'Full description',
                'appear_in_footer' => 1,
                'vision_ar' => null,
                'vision_en' => null,
                'message_ar' => null,
                'message_en' => null,
            ],
            [
                'name_ar' => 'مركز المساعدة',
                'name_en' => 'Help center',
                'short_description_ar' => 'الوصف المختصر',
                'short_description_en' => 'Short description',
                'full_description_ar' => 'الوصف الكامل',
                'full_description_en' => 'Full description',
                'appear_in_footer' => 1,
                'vision_ar' => null,
                'vision_en' => null,
                'message_ar' => null,
                'message_en' => null,
            ],
        ]);
    }
}
