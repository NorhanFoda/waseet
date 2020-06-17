<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' =>  'admin',
                'guard_name' => 'web',
            ],
            [
                'name' =>  'student',
                'guard_name' => 'web',
            ],
            [
                'name' =>  'teacher',
                'guard_name' => 'web',
            ],
            [
                'name' =>  'direct_teacher',
                'guard_name' => 'web',
            ],
            [
                'name' =>  'private_teacher',
                'guard_name' => 'web',
            ],
            [
                'name' =>  'organization',
                'guard_name' => 'web',
            ],
            [
                'name' =>  'job_seeker',
                'guard_name' => 'web',
            ],
        ]);
    }
}
