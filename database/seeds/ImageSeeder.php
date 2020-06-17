<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'path' => 'http://127.0.0.1:8000/images/avatar.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\User',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/avatar.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\User',
            ],
        ]);
    }
}
