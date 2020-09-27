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
        $this->call(StagesSeeder::class);
        $this->call(BagCategorySeeder::class);
        // $this->call(BagSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ModelHasRoleSeeder::class);
        $this->call(MaterialsSeeder::class);
        $this->call(MaterialStageSeeder::class);
        $this->call(EduTypeSeeder::class);
        $this->call(EduLevelSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(StaticPagesSeeder::class);
        $this->call(SocialSeeder::class);
        // $this->call(PaymentMethodsSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(GoalSeeder::class);
        $this->call(specializationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BankReceiptSeeder::class);
        $this->call(MaterialUserSeeder::class);
        // $this->call(JobSeeder::class);
    }
}
