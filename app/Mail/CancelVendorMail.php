<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelVendorMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public $name, $cancel;
    public function __construct($name, $cancel)
    {
        $this->cancel = $cancel;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('De beheerder wil graag dat u dit annuleringsverzoek beoordeelt.')
            ->view('mails.vendor.cancel.cancel');
    }
}
