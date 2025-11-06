<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Event;
use App\Models\User;
use App\Models\Order;
use App\Models\Ticket;
use App\Mail\OrderConfirmation;

use Mollie\Laravel\Facades\Mollie;


class PaymentController extends Controller
{
    function buyTicket($id){
      if (!Event::find($id) || Event::find($id)->status != "live"){
        return redirect('events');
      }
      else{
        return view('checkout.event', [ 'event' => Event::find($id), 'user' => Auth::user() ]);
      }
    }

    function processTicketPayment(Request $request){
      $request->validate([
        'eventId' => ['required'],
        'email' => ['required'],
        'phone' => ['required'],
        'first_name' => ['required'],
        'last_name' => ['required'],
        'street' => ['required'],
        'zip' => ['required'],
        'town' => ['required'],
        'country' => ['required']
      ]);

      $order = new Order;
      $order->product_code = $request->input('eventId');
      $order->email = $request->input('email');
      $order->phone_number = $request->input('phone');
      $order->first_name = $request->input('first_name');
      $order->last_name = $request->input('last_name');
      $order->street = $request->input('street');
      $order->zip = $request->input('zip');
      $order->town = $request->input('town');
      $order->country = $request->input('country');
      $order->contents = 1;
      $order->paid_by = Auth::user()->id;
      $order->price = strval(number_format(Event::find($request->input('eventId'))->price, 2));
      $order->save();
      $event = Event::find($request->input('eventId'));
      $event->update([
          'sell_count' => $event->sell_count + 1
      ]);

      $payment = Mollie::api()->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => strval(number_format(Event::find($request->input('eventId'))->price, 2))
        ],
        "description" => "Order " . $order->id . " voor " . $order->contents,
        "redirectUrl" => route('checkout.done', $order->id),
        // "webhookUrl" => route('webhooks.mollie'),
        "metadata" => [
            "order_id" => $order->id,
        ],
      ]);

      // if (Order::find($order->id)->paid == "pending"){
      //   $ticket = new Ticket;
      //   $ticket->ticketSN = rand(100, 999) . "-" . rand(100,999) . "-" . rand(100,999) . "-" . rand(100,999);
      //   $ticket->eventID = $order->product_code;
      //   $ticket->used = false;
      //   $ticket->usedBy = 0;
      //   $ticket->save();
      //   $event = Event::find($ticket->eventID);
      //   $event->max_tickets = $event->max_tickets - 1;
      //   Mail::to($order->email)->send(new OrderConfirmation(
      //     strval($ticket->ticketSN),
      //     $order->first_name,
      //     $event->start_time,
      //     $event->end_time,
      //     $event->start_date,
      //     $event->name, url('/') . "/event/" . strval($event->id)
      //   ));
      //   $order->paid = "paid";
      //   $order->save();
      //   return http_response_code(200);
      // }
      // return view('checkout.done', [ 'naam' => Auth::user()->first_name, 'email' => Auth::user()->email]);

          // redirect customer to Mollie checkout page
      return redirect($payment->getCheckoutUrl(), 303);
        /*// Payment is done!

        */
      }

      function done($order_id){
        $order = Order::find($order_id);
        // $order = Order::latest()->first();
        if($order){
            if ($order->paid == "pending"){
              $ticket = new Ticket;
              $ticket->ticketSN = rand(100, 999) . "-" . rand(100,999) . "-" . rand(100,999) . "-" . rand(100,999);
              $ticket->eventID = $order->product_code;
              $ticket->used = false;
              $ticket->usedBy = 0;
              $ticket->save();
              $event = Event::find($ticket->eventID);
              $event->max_tickets = $event->max_tickets - 1;
              Mail::to($order->email)->send(new OrderConfirmation(strval($ticket->ticketSN), $order->first_name, $event->start_time, $event->end_time, $event->start_date, $event->end_date, $event->name, url('/') . "/event/" . strval($event->id)));
              $order->paid = "paid";
              $order->save();
              // return http_response_code(200);
            }
            return view('checkout.done', [ 'naam' => Auth::user()->first_name, 'email' => Auth::user()->email]);
        }
        return redirect('/');
      }
}
