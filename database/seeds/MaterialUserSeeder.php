<?php

use Illuminate\Database\Seeder;

class MaterialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('material_user')->insert([
            [
                'user_id' => 1,
                'material_id' => 1,
            ]
        ]);
    }
}
