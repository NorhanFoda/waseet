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
        $this->call(UserSeeder::class);
        $this->call(BagCategorySeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ModelHasRoleSeeder::class);
        $this->call(EduTypeSeeder::class);
        $this->call(EduLevelSeeder::class);
    }
}
