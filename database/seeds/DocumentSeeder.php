<?php

use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert([
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php6C6_1594199662.pdf',
                'doucmentRef_id' => 1,
                'doucmentRef_type' => 'App\User',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php6C6_1594199662.pdf',
                'doucmentRef_id' => 1,
                'doucmentRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php706_1594199662.pdf',
                'doucmentRef_id' => 1,
                'doucmentRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php6C6_1594199662.pdf',
                'doucmentRef_id' => 2,
                'doucmentRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php706_1594199662.pdf',
                'doucmentRef_id' => 2,
                'doucmentRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php6C6_1594199662.pdf',
                'doucmentRef_id' => 3,
                'doucmentRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php706_1594199662.pdf',
                'doucmentRef_id' => 3,
                'doucmentRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php6C6_1594199662.pdf',
                'doucmentRef_id' => 4,
                'doucmentRef_type' => 'App\Models\Bag',
            ],
            [
                'path' => 'https://waset-elmo3lm.jadara.work/documents/php706_1594199662.pdf',
                'doucmentRef_id' => 4,
                'doucmentRef_type' => 'App\Models\Bag',
            ],
        ]);
    }
}
