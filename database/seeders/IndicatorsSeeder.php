<?php

namespace Database\Seeders;

use App\Models\Indicator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class IndicatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Indicator::query()->create([
                'title' => Str::random(),
                'description' => Str::random(),
            ]);
        }
    }
}
