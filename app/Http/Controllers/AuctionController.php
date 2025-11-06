<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Event;
use App\Models\Auction;
use App\Models\Vendor;
use App\Models\AuctionLog;
use App\Models\Coupon;
use App\Models\Movie;
use App\Models\Stall;
use Carbon\Carbon;

class AuctionController extends Controller
{
    function hall($id){
        // dd(Movie::count());
       
        if(env('APP_LOCAL')){
            date_default_timezone_set('Asia/Dhaka');
        }else{
            date_default_timezone_set('Europe/Amsterdam');
        }
      return view('event.auctionhall.hall',[
        'event' => Event::find($id),
        'auctions' => Auction::where('eventID', $id)->where('start_time', '<=', Carbon::now()->format('H:i'))->where('end_time', '>=', Carbon::now()->format('H:i'))->get(),
        'letter' => letterOfWordPrice($id),
        'movies' => Movie::count()
      ]);
    }

    function auction($id, $auctionid){

      return view('event.auctionhall.auction', [
        'event' => Event::find($id),
        'auction' => Auction::find($auctionid),
        'vendor' => Vendor::find(Auction::find($auctionid)->vendorID),
        'userID' => Auth::user()->id,
        'time_left' => 30,
        'letter' => letterOfWordPrice($id)
      ]);
    }

    function viewStall($id, $stallid){
      $event = Event::find($id);
      $stall = Stall::find($stallid);
      // 'vendor' => Vendor::find(Auction::find($auctionid)->vendorID),
      $userID = Auth::user()->id;
      $letter = letterOfWordPrice($id);
      $vendor = Vendor::find($stall->vendorID);
      $products = $vendor->product;
      $coupons = Coupon::where('vendorID', $stall->vendorID)->get();
      return view('event.stall.stall',compact('event','stall','userID','letter','vendor','products', 'coupons'));
    }

    function bid(Request $request){

      $price = $request->input('Price');
      $auctionID = $request->input('id');

      $auction = Auction::find($auctionID);
      if( $price >= ($auction->current_bid + 1)){
        $auction->current_bid = $price;
        $auction->SN = Auth::user()->id;
        $auction->save();
      }

      // Add to log
      if(AuctionLog::where('auctionID', $auction->id)->doesntExist())
      {
        $auctionLog =  AuctionLog::create([
            'log' => json_encode(["actions" => []]),
            'auctionID' => $auctionID,
          ]);
      }
      else
      {
          $auctionLog = AuctionLog::where('auctionID', $auction->id)->first();
      }
      !empty($auctionLog->log) ? $log = json_decode($auctionLog->log, true) : $log = ["actions" => []];
      array_push($log['actions'], "[VEILING BOD] " . "Naam: " . Auth::user()->first_name . " " . Auth::user()->last_name . " Prijs: " . $price);


      $auctionLog->log = json_encode($log);
      $auctionLog->save();

      return redirect()->back();

    }
}
