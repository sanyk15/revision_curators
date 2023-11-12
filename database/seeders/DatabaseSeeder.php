<?php

namespace Database\Seeders;

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
        $this->call([
//            UsersSeeder::class,
//            ActivityKindsSeeder::class,
//            BenchmarksSeeder::class,
//            IndicatorsSeeder::class,
//            GroupsSeeder::class,
            ActivitiesSeeder::class,
        ]);
    }
}
