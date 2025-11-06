<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\GoodiebagConfirmation;
use App\Mail\GoodiebagRequest;
use App\Mail\PopupConfirmation;
use App\Mail\PopupRequest;

use App\Models\Stall;
use App\Models\User;
use App\Models\Event;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Vendor;
use App\Models\Goodiebag;
use App\Models\Popupprice;
use Carbon\Carbon;

class StallHallController extends Controller
{
  function stallhall($id){
    $event = Event::find($id);
    $stallsDB = Stall::where('eventID', $id)->where('visibility', 1)->get();
    $wideStall = 0;
    $newRow = 0;
    $slot = 1;
    $count = 1;
    $stalls = [];
    // dd($stallsDB);
    foreach ( $stallsDB as $stall ){
      if($stall->enabled != 0){
        $vendor = Vendor::find($stall->vendorID);
        $stalls[$count][0] = $stall->id;
        $stalls[$count][1] = $vendor->name ?? '';
        $stalls[$count][2] = $stall->logo_url;




        if ($newRow == 1){
          // -- One of the 4 slots is wide, other small; -randomize
          $wideStall = rand(1, 4);
          $newRow = 0;

        }
        if ($slot == $wideStall) $stalls[$count][3] = "1";
        else $stalls[$count][3] = "0";
        $color = rand(1,3);
        switch ($color){
        case 1:
        $stalls[$count][4] = "white";
        $stalls[$count][5] = "black";
        break;
        case 2:
        $stalls[$count][4] = "";
        $stalls[$count][5] = "";
        break;
        case 3:
        $stalls[$count][4] = "yellow";
        $stalls[$count][5] = "";
        break;
      }
      if ($slot == 4) {
        $newRow = 1;
        $slot = 0;
      }
      $slot++;
      $count++;
      }
    }
    $remaining_seconds = Carbon::now()->diffInSeconds(Carbon::parse($event->end_date.' '. $event->end_time.':00'), false);
    // $remaining_seconds = Carbon::now()->diffInSeconds(Carbon::parse($event->end_date.' '. $event->end_time.':00'), false);

    // dd($remaining_seconds);

    if($remaining_seconds < -300)
    {
      return view('event.no_event', [
        'title' => 'Stall Hall',
        'event' => Event::find($id),
        'letter' => letterOfWordPrice($id)
      ]);
    }


    // dd($stalls);
    return view('event.stallhall.hall', [
      'stalls' => $stalls,
      'event' => Event::find($id),
      'letter' => letterOfWordPrice($id)
    ]);
  }

  function stall($eventid, $id){
    // dd(Carbon::now()->diffForHumans(Carbon::parse(Event::find($eventid)->end_time)));
    $stall = Stall::find($id);
    $vendor = Vendor::find($stall->vendorID);
    $products = Product::where('vendorID', $stall->vendorID)->get();
    // $products = Product::where('vendorID', $stall->vendorID)->whereColumn('products.stock', '>', 'products.sell_count')->get();
    $coupons = Coupon::where('vendorID', $stall->vendorID)->get();
    $event = Event::find($eventid);
    $remaining_seconds = Carbon::now()->diffInSeconds(Carbon::parse($event->end_date.' '. $event->end_time.':00'), false);

    // dd($remaining_seconds);

    if($remaining_seconds < -300)
    {
      return view('event.no_event', [
        'title' => 'Stall Hall',
        'event' => Event::find($id),
        'letter' => letterOfWordPrice($id)
      ]);
    }

      // dd($remaining_seconds);


    if ($stall->eventID != $eventid) return redirect('/event/' . $eventid . '/stallhall');
    else return view('event.stallhall.stall',[
    'stall' => $stall,
    'products' => $products,
    'coupons' => $coupons,
    'event' => Event::find($eventid),
    'vendor' => $vendor,
    'letter' => letterOfWordPrice($eventid),
    'goodiebag' => Goodiebag::where('stallID', $stall->id)->first(),
    'user' => Auth::user(),
    'remaining_seconds' => $remaining_seconds
  ]);
  }

  function goodiebag($id){
    $goodiebag = Goodiebag::find($id);
    if ($goodiebag->stock >= 1){
      $claimed_by[] = explode(',', $goodiebag->claimed_by);
      if(!in_array(Auth::user()->id, $claimed_by[0])){
      array_push($claimed_by[0], Auth::user()->id);
      $goodiebag->claimed_by = implode(",", $claimed_by[0]);
      $goodiebag->stock = $goodiebag->stock - 1;
      $goodiebag->save();
      Mail::to(Auth::user()->email)->send(new GoodiebagConfirmation($goodiebag, Auth::user()->first_name));
    //   Mail::to(User::find(Vendor::find(Stall::find($id)->vendorID)->ownerID)->email)->send(new GoodiebagRequest(Auth::user(), User::find(Vendor::find(Stall::find($id)->vendorID)->ownerID)->first_name));
      Mail::to('info@e-stalls.nl')->send(new GoodiebagRequest(Auth::user(), 'E-STALLS EVENTS'));
      Mail::to('prijzen@e-stalls.nl')->send(new GoodiebagRequest(Auth::user(), 'E-STALLS EVENTS'));
      }
    }
    return redirect()->back()->with('success', 'Hoera, je hebt een goodiebag geclaimd! 🎉 Houd je inbox in de gaten voor meer info!');
  }

  function popup($id){
    $popup = Popupprice::find($id);
    $claimed_by[] = explode(',', $popup->claimed_by);
    if(!in_array(Auth::user()->id, $claimed_by[0])){
    array_push($claimed_by[0], Auth::user()->id);
    $popup->claimed_by = implode(",", $claimed_by[0]);
    $popup->save();
    Mail::to(Auth::user()->email)->send(new PopupConfirmation($popup));
    foreach(User::where('permission', 3)->get() as $admin){
      Mail::to($admin->email)->send(new PopupRequest(Auth::user(), "E-STALLS EVENTS"));
    }
    }
    return redirect()->back()->with('success', 'Hoera, je hebt je prijs geclaimd! 🎉
Houd je inbox in de gaten voor meer info!');
  }

  // function goodiebagPopup($id){
  //   $goodiebag = Goodiebag::find($id);
  //   $claimed_by[] = explode(',', $goodiebag->claimed_by);
  //   if(!in_array(Auth::user()->id, $claimed_by[0])){
  //   array_push($claimed_by[0], Auth::user()->id);
  //   $goodiebag->claimed_by = implode(",", $claimed_by[0]);
  //   $goodiebag->stock = $goodiebag->stock - 1;
  //   $goodiebag->save();
  //   Mail::to(Auth::user()->email)->send(new PopupConfirmation($goodiebag, Auth::user()->first_name));
  //   foreach(User::where('permission', 3)->get() as $admin){
  //     Mail::to($admin->email)->send(new PopupRequest(Auth::user(), "E-STALLS EVENTS"));
  //   }
  //   }
  //   return redirect()->back();
  // }

  function product($eventid, $id){
    $product = Product::find($id);
    $vendor = Vendor::find($product->vendorID);
    $stall = Stall::where("vendorID", $vendor->id)->where('eventID', $eventid)->first();

    return view('event.stallhall.product', [
      'product' => $product,
      'stall' => $stall,
      'event' => Event::find($eventid),
      'vendor' => $vendor,
      'letter' => letterOfWordPrice($eventid)
    ]);
  }

  function coupon($eventid, $id){
    $coupon = Coupon::find($id);
    $vendor = Vendor::find($coupon->vendorID);
    $stall = Stall::where("vendorID", $vendor->id)->where('eventID', $eventid)->first();

    return view('event.stallhall.coupon', [
      'coupon' => $coupon,
      'stall' => $stall,
      'event' => Event::find($eventid),
      'vendor' => $vendor,
      'letter' => letterOfWordPrice($eventid)
    ]);
  }
}
