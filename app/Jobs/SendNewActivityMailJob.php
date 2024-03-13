<?php

namespace App\Jobs;

use App\Mail\NewActivityMail;
use App\Models\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewActivityMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $emails;
    private Activity $activity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $emails, Activity $activity)
    {
        $this->emails = $emails;
        $this->activity = $activity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->emails)->send(new NewActivityMail($this->activity));
    }
}
