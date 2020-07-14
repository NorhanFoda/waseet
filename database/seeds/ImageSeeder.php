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
            // User
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
            // BagCategory
            [
                'path' => 'http://127.0.0.1:8000/images/phpD8B7_1594474093.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\BagCategory',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php5CBD_1594474127.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\BagCategory',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/phpC28C_1594474153.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\BagCategory',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php1DAD_1594474176.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\BagCategory',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/phpA349_1594474210.png',
                'imageRef_id' => '5',
                'imageRef_type' => 'App\Models\BagCategory',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php222F_1594474243.png',
                'imageRef_id' => '6',
                'imageRef_type' => 'App\Models\BagCategory',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php9D4B_1594474274.png',
                'imageRef_id' => '7',
                'imageRef_type' => 'App\Models\BagCategory',
            ],
            // Bag
            [
                'path' => 'http://127.0.0.1:8000/images/php76A1_1594481343.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A2_1594481344.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A3_1594481344.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A1_1594481343.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A2_1594481344.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A3_1594481344.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A1_1594481343.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A2_1594481344.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A3_1594481344.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A1_1594481343.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A2_1594481344.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php76A3_1594481344.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\Bag',
            ],

            //Slider
            [
                'path' => 'http://127.0.0.1:8000/images/php6F9D_1594306099.jpg',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\Slider',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php6F9D_1594306099.jpg',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\Slider',
            ],
            [
                'path' => 'http://127.0.0.1:8000/images/php6F9D_1594306099.jpg',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\Slider',
            ],
        ]);
    }
}
