<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            [
                'name_ar' => 'المملكة العربية السعودية',
                'name_en' => 'Suadi Arabia Kingdom',
            ],
            [
                'name_ar' => 'جمهورية مصر العربية',
                'name_en' => 'The Egyption Arabic Republic',
            ],
        ]);
    }
}
