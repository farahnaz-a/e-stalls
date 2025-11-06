<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PopupConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $popup;
     public function __construct($popup)
     {
         $this->popup = $popup; 

     }

     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         return $this->subject('Je hebt een prijs ontvangen!')->view('mails.popup.index');
     }
}
