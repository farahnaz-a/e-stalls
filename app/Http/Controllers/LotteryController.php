<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Lottery;
use App\Models\Wordprice;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use App\Mail\LotteryWinner;
use Carbon\Carbon;
class LotteryController extends Controller
{
    function main($id){
      $lottery = Lottery::where('eventID', $id)->first();
      $date = $lottery->release_date .' '.$lottery->release_time.':00';

      $event = Event::find($id);
      if (!empty($lottery->winning_tickets)){
        if(Carbon::now()->timezone('Europe/Amsterdam')->format('Y-m-d H:i:s') > Carbon::parse($date)->format('Y-m-d H:i:s')){
          $winningTicket = explode(',', $lottery->winning_tickets)[1];
          return view('event.lottery.main.result', [
            'lottery' => $lottery,
            'event' => $event,
            'winning_ticket' => $winningTicket
          ]);
        }
      }
      return view('event.lottery.main.wait', ['lottery' => $lottery, 'event' => $event]);

    }

    // function wordprice($id){
    //   $wordprice = Wordprice::where('eventID', $id)->first();
    //   $event = Event::find($id);
    //   $eventTickets = Ticket::where('eventID', $id)->get();
    //   $userTicket = $eventTickets->where('usedBy', Auth::user()->id)->first()->ticketSN ?? '';
    //   if(!empty($wordprice->winning_tickets)){
    //     if (in_array($userTicket, explode(',', $wordprice->winning_tickets))){
    //       return view('event.lottery.wordprice.won', ['wordprice' => $wordprice, 'event' => $event]);
    //     }
    //     else {
    //       return view('event.lottery.wordprice.lost', ['wordprice' => $wordprice, 'event' => $event]);
    //     }
    //   }
    //   else if (in_array($userTicket, explode(',', $wordprice->participating_tickets))) return view('event.lottery.wordprice.wait', ['wordprice' => $wordprice, 'event' => $event]);
    //   else return view('event.lottery.wordprice.enter', ['wordprice' => $wordprice, 'event' => $event]);
    // }

    function wordprice($id){
      $wordprice = Wordprice::where('eventID', $id)->first();
      $event = Event::find($id);
    //   $eventTickets = Ticket::where('eventID', $id)->get();
      $userTicket = Ticket::where('eventID', $id)->where('usedBy', Auth::user()->id)->orderBy('id', 'desc')->first()->ticketSN ?? '';
      // dd($wordprice->participating_tickets);
      // dd(in_array($userTicket, explode(',', $wordprice->participating_tickets)));
      // if(!empty($wordprice->winning_tickets)){
      if(env('APP_LOCAL')){
        date_default_timezone_set('Asia/Dhaka');
      }else{
        date_default_timezone_set('Europe/Amsterdam');
      }
        if($wordprice->release_date == Carbon::today()->format('Y-m-d') && Carbon::now()->format('H:i') <= $wordprice->release_time){
            if(in_array($userTicket, explode(',', $wordprice->participating_tickets))){
                return view('event.lottery.wordprice.wait', ['wordprice' => $wordprice, 'event' => $event]);   
            }else{
                return view('event.lottery.wordprice.enter', ['wordprice' => $wordprice, 'event' => $event]);     
            }
        }else{
            if(in_array($userTicket, explode(',', $wordprice->winning_tickets))){
                return view('event.lottery.wordprice.won', ['wordprice' => $wordprice, 'event' => $event]);
            }else{
                return view('event.lottery.wordprice.lost', ['wordprice' => $wordprice, 'event' => $event]);
            }
        }
    //     if (in_array($userTicket, explode(',', $wordprice->winning_tickets))){
    
    //       return view('event.lottery.wordprice.won', ['wordprice' => $wordprice, 'event' => $event]);
    //     }
    //     else if (in_array($userTicket, explode(',', $wordprice->participating_tickets))) 
    //     {
    //       // dd($wordprice->participating_tickets);
    //       return view('event.lottery.wordprice.wait', ['wordprice' => $wordprice, 'event' => $event]);
    //     }
    //     else {
    //       return view('event.lottery.wordprice.lost', ['wordprice' => $wordprice, 'event' => $event]);
    //     }
    //   // }
    //   // else {
    //     return view('event.lottery.wordprice.enter', ['wordprice' => $wordprice, 'event' => $event]);
    //   // }
    }

    function checkWord($id, Request $request){
      $wordprice = Wordprice::where('eventID', $id)->first();
      $eventTickets = Ticket::where('eventID', $id)->get();
      $userTicket = $eventTickets->where('usedBy', Auth::user()->id)->first()->ticketSN ?? '';
      $code = []; 
      foreach(str_split($wordprice->word) as $key=>$letter){
        array_push($code, $request->input($key));
      }
      if ($code == str_split($wordprice->word)){
        $currentCorrect = explode(',', $wordprice->correct_tickets);
        array_push($currentCorrect, $userTicket);
        $wordprice->correct_tickets = implode(',', $currentCorrect);
      }
      $currentParticipating = explode(',', $wordprice->participating_tickets);
       array_push($currentParticipating, $userTicket);
      $wordprice->participating_tickets = implode(',', $currentParticipating);
      $wordprice->save();
      return redirect('event/' . $id . '/woordprijs');
    }

    function tempor(){
      // -- WordPrice check-up
      $wordprice = Wordprice::where('eventID', 1)->first();
      date_default_timezone_set('Europe/Amsterdam');
      if (date('H') . ':' . date('i') == $wordprice->release_time){
      if(empty($wordprice->winning_tickets)){
        if(!empty($wordprice->correct_tickets)){
        $i=0;
        $correctTickets = explode(',', $wordprice->correct_tickets);
        while($i != ($wordprice->p1_amount + $wordprice->p2_amount + $wordprice->p3_amount)){
          $chosenTicket = $correctTickets[rand(0, (count($correctTickets)-1))];
          $winningTickets = explode(',', $wordprice->winning_tickets);
          if (!in_array ($chosenTicket, $winningTickets)){
            array_push($winningTickets, $chosenTicket);
            $wordprice->winning_tickets = implode(',', $winningTickets);
            $wordprice->save();
            if($wordprice->p1_amount != 0){
              $price = $wordprice->p1;
              $wordprice->p1_amount = $wordprice->p1_amount -1;
              $wordprice->save();
            }
            elseif(!empty($wordprice->p2)){
              if($wordprice->p2_amount != 0){
                $price = $wordprice->p2;
                $wordprice->p2_amount = $wordprice->p2_amount -1;
                $wordprice->save();
              }
              elseif(!empty($wordprice->p3)){
                $price = $wordprice->p3;
                $wordprice->p3_amount = $wordprice->p3_amount -1;
                $wordprice->save();
              }
            }
            Mail::to(User::find(Ticket::where('ticketSN', $chosenTicket)->first()->usedBy)->email)->send(new LotteryWinner(strval($chosenTicket), User::find(Ticket::where('ticketSN', $chosenTicket)->first()->usedBy)->first_name, $price, "tempor", url('/') . "/event/1"));
            $i++;
          }
        }
      }
        else{
          $wordprice->winning_tickets = "1";
          $wordprice->save();
        }
      }
    }
  }


}
