<?php

use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert([
            [
                'link' => 'https://www.facebook.com',
                'icon' => 'fa fa-facebook-f'
            ],
            [
                'link' => 'https://www.twitter.com',
                'icon' => 'fa fa-twitter'
            ],
            [
                'link' => 'https://www.snapchat.com',
                'icon' => 'fa fa-snapchat'
            ],
            [
                'link' => 'https://www.instagram.com',
                'icon' => 'fa fa-instagram'
            ],
        ]);
    }
}
