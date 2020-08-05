<?php

use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            [
                'path' => 'https://waset-elmo3lm.jadara.work/videos/php728_1594199662.mp4',
                'videoRef_id' => 1,
                'videoRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/videos/php748_1594199663.mp4',
                'videoRef_id' => 1,
                'videoRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/videos/php728_1594199662.mp4',
                'videoRef_id' => 2,
                'videoRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/videos/php748_1594199663.mp4',
                'videoRef_id' => 2,
                'videoRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/videos/php728_1594199662.mp4',
                'videoRef_id' => 3,
                'videoRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/videos/php748_1594199663.mp4',
                'videoRef_id' => 3,
                'videoRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/videos/php728_1594199662.mp4',
                'videoRef_id' => 4,
                'videoRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/videos/php748_1594199663.mp4',
                'videoRef_id' => 4,
                'videoRef_type' => 'App\Models\Bag',
            ],
        ]);
    }
}
