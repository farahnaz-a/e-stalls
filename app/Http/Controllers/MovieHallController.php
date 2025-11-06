<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Movie;
use Carbon\Carbon;

class MovieHallController extends Controller
{
    function index($id){
      $movies = Movie::where('eventID', $id)->where('enabled', 1)->where('visibility', 1)->get();

      $event = Event::find($id);

      $remaining_minutes = Carbon::now()->diffInMinutes(Carbon::parse($event->end_time), false);


      // dd($remaining_minutes);

      if($remaining_minutes < -30)
      {
        return view('event.no_event', [
          'title' => 'Stall Hall',
          'event' => Event::find($id),
          'letter' => letterOfWordPrice($id)
        ]);
      }
      return view('event.moviehall.index', [
        'event' => $event,
        'movies' => $movies,
        'letter' => letterOfWordPrice($id)
      ]);
    }

    function movie($id, $movie){
      $movie = Movie::find($movie);
      $event = Event::find($id);
      return view('event.moviehall.movie', [
        'event' => $event,
        'movie' => $movie,
        'letter' => letterOfWordPrice($id)
      ]);
    }
}
