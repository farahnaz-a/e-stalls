<?php
use App\Models\Event;
use App\Models\User;
use App\Models\Wordprice;
use App\Models\Popupprice;
use App\Models\Goodiebag;
use App\Models\Vendor;

use Illuminate\Support\Facades\Auth;

function is_active($id){
  $event = Event::find($id);
  if ($event->status == "live"){
    if ($event->start_date == date('Y-m-d')){
      if(env('APP_LOCAL')){
        date_default_timezone_set('Asia/Dhaka');
      }else{
        date_default_timezone_set('Europe/Amsterdam');
      }
    $currentTime = date('H') * 60 + date('i');
    $startTime = intval(substr($event->start_time, 0 ,2)) * 60 + intval(substr($event->start_time, -2));
    $endTime = intval(substr($event->end_time, 0 , 2)) * 60 + intval(substr($event->end_time, -2));
    if ($startTime <= $currentTime && $endTime >= $currentTime) return true;
    else return false;
    return true;
  }
  }
  else return false;
}

function canEnterEvent($id){
  $user = Auth::user();
  if ($user->entered_event != $id && $user->permission != 3){
    return false;
  }
  else {
    return true;
  }
}

function letterOfWordPrice($id){
  $wordprice = Wordprice::where('eventID', $id)->first();
  if($wordprice && rand(0,3) == 1){
    // -- show a letter
    $chars = str_split($wordprice->word);
      $random_index = rand(0, count($chars) - 1);
    return [$random_index => $chars[$random_index]];
  }
  else return '~';


}

function popupPrice($id){
  $popupPrice = Popupprice::where('eventID', $id)->first();
  if(rand(0,1) == 1){
    return $popupPrice->id;
  }
}

function goodiebagPrice($id){
  $goodiePopupPrice = Goodiebag::where('eventID', $id)->where('enabled', 1)->where('status', 'live')->first();
  if(rand(0,1) == 1){
    return $goodiePopupPrice->id;
  }
}

function getCurrentVendor(){
  return Vendor::where('ownerID', Auth::user()->id)->first();
}
