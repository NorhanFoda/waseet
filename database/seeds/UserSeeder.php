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
                'phone_main' => '00966563793461',
                'is_verified' => 1,
                'stage_id' => null,
            ],
            [
                'name' => 'test',
                'email' => 'test@jaadara.com',
                'password' => bcrypt('123456789'),
                'phone_main' => '00966563793462',
                'stage_id' => 1,
            ],
        ]);
    }
}
