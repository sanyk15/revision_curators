<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ActivityKind;
use App\Models\Benchmark;
use App\Models\Group;
use App\Models\Indicator;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activityKind = ActivityKind::query()->first();
        $benchmark = Benchmark::query()->first();
        $indicator = Indicator::query()->first();
        $user = User::query()->first();
        $group = Group::query()->first();

        for ($i = 0; $i < 30; $i++) {
            Activity::query()->create([
                'title' => Str::random(),
                'activity_kind_id' => $activityKind->id,
                'benchmark_id' => $benchmark->id,
                'indicator_id' => $indicator->id,
                'user_id' => $user->id,
                'group_id' => $group->id,
                'date' => Carbon::now()->subMonth()->endOfMonth()->subDays(rand(0, 30)),
                'threshold' => rand(),
                'assessment_frequency' => rand(),
                'possible_score' => rand(),
                'curator_score' => rand(),
            ]);
        }
    }
}
