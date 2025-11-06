<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Event;
use App\Models\Stall;
use App\Models\Logoad;
use App\Models\Popupprice;
use App\Models\Goodiebag;
use Carbon\Carbon;

class EventController extends Controller
{
    function index($id){
      if (canEnterEvent($id) == true){
        $ads = Logoad::where('eventID', $id)->where('enabled', 1)->get();
        // $endDate = Carbon::parse(Event::find($id)->end_date);
        // $endTime = Carbon::parse(Event::find($id)->end_time);
        // $popup = Popupprice::find(popupPrice($id));
        // $goodiebag = Goodiebag::find(goodiebagPrice($id));
        
        // dd();
        $randomPrice = rand(1, 2);
        if ($randomPrice == 1) $data = Popupprice::where('eventID', $id)->inRandomOrder()->first();
        else $data = Goodiebag::where('eventID', $id)->where('enabled', 1)->where('status', 'live')->inRandomOrder()->first();



        return view('event.index', [
          'event' => Event::find($id),
          'ads' => $ads,
          'letter' => letterOfWordPrice($id),
          // 'popup' => Popupprice::find(popupPrice($id)),
          'randomPrice' => $randomPrice,
          'data' => $data,
        ]);
      }
      else return redirect('event/' . $id . '/verzilveren');
    }

    function exit(){
      $user = Auth::user();
      $user->entered_event = "";
      $user->save();
      return redirect('dashboard');
    }
}
