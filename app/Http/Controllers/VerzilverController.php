<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class VerzilverController extends Controller
{
    function index($id){
      return view('event.verzilveren.index', [
        'event' => Event::find($id)
      ]);
    }

    function authTicket(Request $request){
      $request->validate([
        'ticketID' => ['required']
      ]);
      $ticket = Ticket::where('ticketSN', $request->input('ticketID'))->where('eventID', $request->input('eventID'))->where('used', 0)->first();
        if($ticket){
            $user = Auth::user();
            $user->entered_event = $request->input('eventID');
            $user->save();
            $ticket->usedBy = $user->id;
            $ticket->used = 1;
            $ticket->save();
            return redirect('event/' . $request->input('eventID'));
        }
    //   if ($ticketsbyID->get()){
    //   foreach( Ticket::where('ticketSN', $request->input('ticketID'))->get() as $ticket){
    //     if ($ticket->used == 0 && $ticket->eventID == $request->input('eventID')){
    //       // Ticket is accepted
    //       echo('Approved.');
    //       $user = Auth::user();
    //       $user->entered_event = $request->input('eventID');
    //       $user->save();
    //       $ticket->usedBy = $user->id;
    //       $ticket->used = 1;
    //       $ticket->save();
    //       return redirect('event/' . $request->input('eventID'));
    //     }
    //   }
    //   return back()->withInput();
    //   }
    //   else return back()->withInput();
        return back()->withInput();
    }
}
