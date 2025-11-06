<?php

namespace App\Console;

use App\Mail\EventReminderMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

use App\Models\Lottery;
use App\Models\Wordprice;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use App\Mail\LotteryWinner;
use App\Models\Goodiebag;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->call(function(){
        $events = Event::all();
        foreach($events as $event){
          if(is_active($event->id)){
            // -- General lottery check-up
            $lottery = Lottery::where('eventID', $event->id)->first();
            if(env('APP_LOCAL')){
              date_default_timezone_set('Asia/Dhaka');
            }else{
              date_default_timezone_set('Europe/Amsterdam');
            }
            if (date('H') . ':' . date('i') == $lottery->release_time){
              if(empty($lottery->winning_tickets)){
                $enteredTickets = Ticket::where('used', 1)->get();
                $i=0;
                while($i != $lottery->price_amount){
                  $chosenTicket = $enteredTickets[rand(0, (count($enteredTickets)-1))]->ticketSN;
                  $winningTickets = explode(',', $lottery->winning_tickets);
                  if (!in_array ($chosenTicket, $winningTickets)){
                    array_push($winningTickets, $chosenTicket);
                    $lottery->winning_tickets = implode(',', $winningTickets);
                    $lottery->save();
                    Mail::to(User::find(Ticket::where('ticketSN', $chosenTicket)->first()->usedBy)->email)->send(new LotteryWinner(strval($chosenTicket), User::find(Ticket::where('ticketSN', $chosenTicket)->first()->usedBy)->first_name, $lottery->price_name, $event->name, url('/') . "/event/" . strval($event->id)));
                    $i++;
                  }
                }
              }
            }
            // -- WordPrice check-up
            $wordprice = Wordprice::where('eventID', $event->id)->first();
            if(env('APP_LOCAL')){
              date_default_timezone_set('Asia/Dhaka');
            }else{
              date_default_timezone_set('Europe/Amsterdam');
            }
            // dd(date('H') . ':' . date('i'), $wordprice->release_time);
            if (date('H') . ':' . date('i') == $wordprice->release_time){
              if(empty($wordprice->winning_tickets)){
                if(!empty($wordprice->correct_tickets)){
                  $i=0;
                  $correctTickets = explode(',', $wordprice->correct_tickets);
                  if (count(explode(',', $wordprice->correct_tickets)) < ($wordprice->p1_amount + $wordprice->p2_amount + $wordprice->p3_amount)){
                    $amountOfWinners = count(explode(',', $wordprice->correct_tickets));
                  }
                  else $amountOfWinners = $wordprice->p1_amount + $wordprice->p2_amount + $wordprice->p3_amount;

                  while($i != $amountOfWinners){

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
                      Mail::to(User::find(Ticket::where('ticketSN', $chosenTicket)->first()->usedBy)->email)->send(new LotteryWinner(strval($chosenTicket), User::find(Ticket::where('ticketSN', $chosenTicket)->first()->usedBy)->first_name, $price, $event->name, url('/') . "/event/" . strval($event->id)));
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

            // if(Carbon::parse($event->end_date.' '.$event->end_time.':00')->format('Y-m-d H:i:s') > Carbon::now()->timezone('Europe/Amsterdam')->format('Y-m-d H:i:s')){ 
            //     // if(Carbon::now()->timezone('Europe/Amsterdam')->format('Y-m-d H:i:s') > Carbon::parse($event->end_date.' '.$event->end_time.':00')->subMinutes(15)->format('Y-m-d H:i:s')){
            //     //     if(!$event->alert_15_min_before){
            //     //         $event->update([
            //     //             'alert_15_min_before' => 1,
            //     //         ]);
            //     //         $users = User::whereIn('id', Order::where('product_code', $event->id)->where('paid', 'paid')->pluck('paid_by')->toArray())->get();
            //     //         foreach ($users as $user){
            //     //             Mail::to($user->email)->send(new EventReminderMail($user->first_name, 'Het evenement is bijna voorbij', 'Het event sluit over 15 minuten! Na het event heb je nog 30 minuten om je winkelmandje af te rekenen!'));
            //     //         }
            //     //     }
            //     // }elseif(Carbon::now()->timezone('Europe/Amsterdam')->format('Y-m-d H:i:s') > Carbon::parse($event->end_date.' '.$event->end_time.':00')->subMinutes(30)->format('Y-m-d H:i:s')){
            //     //     if(!$event->alert_30_min_before){
            //     //         $event->update([
            //     //             'alert_30_min_before' => 1,
            //     //         ]); 
            //     //         $users = User::whereIn('id', Order::where('product_code', $event->id)->where('paid', 'paid')->pluck('paid_by')->toArray())->get();
            //     //         foreach ($users as $user){
            //     //             Mail::to($user->email)->send(new EventReminderMail($user->first_name, 'Het evenement is bijna voorbij', 'Het event sluit over 30 minuten! Je hebt nog maar even de tijd om de beste deals te scoren.'));
            //     //         }
            //     //     }
            //     // }elseif(Carbon::now()->timezone('Europe/Amsterdam')->format('Y-m-d H:i:s') > Carbon::parse($event->end_date.' '.$event->end_time.':00')->subMinutes(60)->format('Y-m-d H:i:s')){
            //     //     if(!$event->alert_60_min_before){
            //     //         $event->update([
            //     //             'alert_60_min_before' => 1,
            //     //         ]);
            //     //         $users = User::whereIn('id', Order::where('product_code', $event->id)->where('paid', 'paid')->pluck('paid_by')->toArray())->get();
            //     //         foreach ($users as $user){
            //     //             Mail::to($user->email)->send(new EventReminderMail($user->first_name, 'Het evenement is bijna voorbij', 'Het event eindigt over 1 uur! Zorg dat je niets mist!'));
            //     //         }
            //     //     }
            //     // }
            // }

            if(Carbon::now()->timezone('Europe/Amsterdam')->format('Y-m-d H:i:s') > Carbon::parse($event->end_date.' '.$event->end_time.':00')->format('Y-m-d H:i:s')){
                $goodiebags = Goodiebag::where('status', 'live')->where('eventID', $event->id)->get();
                foreach($goodiebags as $goodiebag){
                    $goodiebag->update([
                        'status' => 'archive',
                    ]);
                }
            }
        }
      })->everyMinute();
    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
