<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventCollectionController extends Controller
{
    function index(){
      return view('events.index', [
        'events' => Event::all()
      ]);
    }
}
