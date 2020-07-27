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
                'path' => 'https://waset-elmo3lm.jadara.work/images/avatar.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\User',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/avatar.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\User',
                'type' => null,
            ],
            // BagCategory
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/phpD8B7_1594474093.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\BagCategory',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php5CBD_1594474127.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\BagCategory',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/phpC28C_1594474153.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\BagCategory',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php1DAD_1594474176.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\BagCategory',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/phpA349_1594474210.png',
                'imageRef_id' => '5',
                'imageRef_type' => 'App\Models\BagCategory',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php222F_1594474243.png',
                'imageRef_id' => '6',
                'imageRef_type' => 'App\Models\BagCategory',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php9D4B_1594474274.png',
                'imageRef_id' => '7',
                'imageRef_type' => 'App\Models\BagCategory',
                'type' => null,
            ],
            // Bag
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A1_1594481343.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A2_1594481344.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A3_1594481344.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A1_1594481343.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A2_1594481344.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A3_1594481344.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A1_1594481343.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A2_1594481344.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A3_1594481344.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A1_1594481343.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A2_1594481344.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php76A3_1594481344.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\Bag',
                'type' => null,
            ],

            //Slider
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php6F9D_1594306099.jpg',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\Slider',
                'type' => 'website',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php6F9D_1594306099.jpg',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\Slider',
                'type' => 'website',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php6F9D_1594306099.jpg',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\Slider',
                'type' => 'website',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/php272_1594472860.png',
                'imageRef_id' => '4',
                'imageRef_type' => 'App\Models\Slider',
                'type' => 'mobile',
            ],

            // Payment methods
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/visa.png',
                'imageRef_id' => '1',
                'imageRef_type' => 'App\Models\PaymentMethod',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/master.png',
                'imageRef_id' => '2',
                'imageRef_type' => 'App\Models\PaymentMethod',
                'type' => null,
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/images/mada.png',
                'imageRef_id' => '3',
                'imageRef_type' => 'App\Models\PaymentMethod',
                'type' => null,
            ],
        ]);
    }
}
