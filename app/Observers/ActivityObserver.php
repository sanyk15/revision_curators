<?php

namespace App\Observers;

use App\Jobs\SendNewActivityMailJob;
use App\Models\Activity;
use App\Models\User;

class ActivityObserver
{
    /**
     * Handle the Activity "created" event.
     *
     * @param Activity $activity
     *
     * @return void
     */
    public function created(Activity $activity)
    {
        dispatch(new SendNewActivityMailJob(User::query()->curators()->get()->pluck('email')->values()->toArray(), $activity));
    }

    /**
     * Handle the Activity "updated" event.
     *
     * @param Activity $activity
     *
     * @return void
     */
    public function updated(Activity $activity)
    {
        //
    }

    /**
     * Handle the Activity "deleted" event.
     *
     * @param Activity  $activity
     *
     * @return void
     */
    public function deleted(Activity $activity)
    {
        //
    }

    /**
     * Handle the Activity "restored" event.
     *
     * @param  Activity  $activity
     *
     * @return void
     */
    public function restored(Activity $activity)
    {
        //
    }

    /**
     * Handle the Activity "force deleted" event.
     *
     * @param  Activity  $activity
     *
     * @return void
     */
    public function forceDeleted(Activity $activity)
    {
        //
    }
}
