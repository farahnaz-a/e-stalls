<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GoodiebagConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($goodiebag, $name)
     {
         $this->goodiebag = $goodiebag;
         $this->name = $name;

     }

     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         return $this->subject('Je hebt een goodiebag geclaimd!')->view('mails.goodiebag.index')->with([
           'goodiebag' => $this->goodiebag,
           'name' => $this->name
         ]);
     }
}
