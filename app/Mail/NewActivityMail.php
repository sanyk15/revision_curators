<?php

namespace App\Mail;

use App\Models\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewActivityMail extends Mailable
{
    use Queueable, SerializesModels;

    private Activity $activity;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Создано новое мероприятие')
            ->view('mails.new_activity', ['activity' => $this->activity]);
    }
}
