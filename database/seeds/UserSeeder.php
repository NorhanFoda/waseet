<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Jaadara',
                'email' => 'admin@jaadara.com',
                'password' => bcrypt('123456789'),
                'phone_main' => '+966563793461',
                'is_verified' => 1,
                'approved' => 1,
                'stage_id' => 1,
                'nationality_id' => 1,
                'lat' => '52.36',
                'long' => '52.36',
                'address' => 'الرياض - المملكة العربية السعودية',
                'teaching_lat' => '52.36',
                'teaching_long' => '52.36',
                'teaching_address' => 'الرياض - المملكة العربية السعودية',
                'exper_years' => 5,
                'salary_month' => 5000,
                'age' => 35,
                'bio_ar' => 'معلم خصوصى',
                'bio_en' => 'Provate Teacher',
                'edu_level_id' => 1,
                
            ]
        ]);
    }
}
