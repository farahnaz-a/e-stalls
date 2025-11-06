<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PopupRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($customer, $name)
     {
         $this->customer = $customer;
         $this->name = $name;

     }

     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         return $this->subject('Nieuwe PopUp Prijs voor ' . $this->customer->first_name)->view('mails.vendor.goodiebag.request')->with([
           'customer' => $this->customer,
           'name' => $this->name,
         ]);
     }
}
