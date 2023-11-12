<?php

namespace Database\Seeders;

use App\Models\Benchmark;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BenchmarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Benchmark::query()->create(['title' => Str::random()]);
        }
    }
}
