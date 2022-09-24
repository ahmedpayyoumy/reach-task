<?php

namespace App\Mail;

use App\Models\Advertiser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReminderToAdevertisers extends Mailable
{
    use Queueable, SerializesModels;

    public $advertiser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Advertiser $advertiser)
    {
        $this->advertiser = $advertiser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sendReminderToAdvertisers');
    }
}
