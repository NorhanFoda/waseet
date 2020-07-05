<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NationalitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BagCategorySeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ModelHasRoleSeeder::class);
        $this->call(StagesSeeder::class);
        $this->call(MaterialsSeeder::class);
        $this->call(MaterialStageSeeder::class);
        $this->call(EduTypeSeeder::class);
        $this->call(EduLevelSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(StaticPagesSeeder::class);
    }
}
