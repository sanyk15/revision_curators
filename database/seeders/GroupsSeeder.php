<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Group::query()->create([
                'title' => Str::random(),
                'students_count' => rand(),
                'headman_email' => Str::random(),
            ]);
        }
    }
}
