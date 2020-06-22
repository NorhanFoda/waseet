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
                'name_ar' => 'رياضيات',
                'name_en' => 'Math',
            ],
            [
                'name_ar' => 'علوم',
                'name_en' => 'Science',
            ],
        ]);
    }
}
