<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LotteryWinner extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticketnr, $name, $price, $event_name, $event_url)
    {
        $this->ticketnr = $ticketnr;
        $this->name = $name;
        $this->price = $price;
        $this->event_name = $event_name;
        $this->event_url = $event_url;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Gefeliciteerd, je hebt gewonnen')->view('mails.lottery.won')->with([
          'ticket_number' => $this->ticketnr,
          'name' => $this->name,
          'price' => $this->price,
          'event_name' => $this->event_name,
          'event_url' => $this->event_url
        ]);
    }
}
