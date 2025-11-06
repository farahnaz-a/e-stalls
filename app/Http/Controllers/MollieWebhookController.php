<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Event;

use Mollie\Laravel\Facades\Mollie;


class MollieWebhookController extends Controller
{
  public function handleWebhookNotification(Request $request) {
  $paymentId = $request->input('id');
  $payment = Mollie::api()->payments->get($paymentId);

  if ($payment->isPaid())
  {
    $order = Order::find($payment->metadata->order_id);

    if ($order->paid == "pending"){
      $ticket = new Ticket;
      $ticket->ticketSN = rand(100, 999) . "-" . rand(100,999) . "-" . rand(100,999) . "-" . rand(100,999);
      $ticket->eventID = $order->product_code;
      $ticket->used = false;
      $ticket->usedBy = 0;
      $ticket->save();
      $event = Event::find($ticket->eventID);
      $event->max_tickets = $event->max_tickets - 1;
      Mail::to($order->email)->send(new OrderConfirmation(strval($ticket->ticketSN), $order->first_name, $event->start_time, $event->end_time, $event->start_date, $event->name, url('/') . "/event/" . strval($event->id)));
      $order->paid = "paid";
      $order->save();
      return http_response_code(200);
    }
  }
}
}
