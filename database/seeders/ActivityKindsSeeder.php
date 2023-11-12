<?php

namespace Database\Seeders;

use App\Models\ActivityKind;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivityKindsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            ActivityKind::query()->create(['title' => Str::random()]);
        }
    }
}
