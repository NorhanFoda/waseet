<?php

use Illuminate\Database\Seeder;
use App\Models\Stage;
use App\Models\Material;
use Carbon\Carbon;

class MaterialStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('material_stage')->insert([
            [
                'stage_id' => 1,
                'material_id' => 2,
            ],
            [
                'stage_id' => 2,
                'material_id' => 2,
            ],
            [
                'stage_id' => 3,
                'material_id' => 1,
            ],
        ]);
    }
}
