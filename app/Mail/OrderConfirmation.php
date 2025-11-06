<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticketnr, $name, $start_time, $end_time, $start_date, $end_date, $event_name, $event_url)
    {
        $this->ticketnr = $ticketnr;
        $this->name = $name;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
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
        return $this->subject('Bedankt voor je bestelling!')->view('mails.order.confirmed')->with([
          'ticket_number' => $this->ticketnr,
          'name' => $this->name,
          'start_time' => $this->start_time,
          'end_time' => $this->end_time,
          'start_date' => $this->start_date,
          'end_date' => $this->end_date,
          'event_name' => $this->event_name,
          'event_url' => $this->event_url
        ]);
    }
}
