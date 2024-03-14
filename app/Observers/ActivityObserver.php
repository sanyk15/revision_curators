<?php

namespace App\Observers;

use App\Jobs\SendNewActivityMailJob;
use App\Models\Activity;
use App\Models\User;

class ActivityObserver
{
    public function created(Activity $activity)
    {
        dispatch(new SendNewActivityMailJob(User::query()->curators()->get()->pluck('email')->values()->toArray(), $activity));
    }

    public function creating(Activity $activity)
    {
        $activity->fullByType();
    }
}
