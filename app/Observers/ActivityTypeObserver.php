<?php

namespace App\Observers;

use App\Models\ActivityType;
use Illuminate\Support\Str;

class ActivityTypeObserver
{
    public function creating(ActivityType $activityType)
    {
        $activityType->code = Str::slug($activityType->title);
    }

    public function updating(ActivityType $activityType)
    {
        $activityType->code = Str::slug($activityType->title);
    }
}
