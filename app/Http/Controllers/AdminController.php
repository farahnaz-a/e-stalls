<?php

namespace App\Http\Controllers;

use App\Mail\AuctionNotificationMail;
use App\Mail\VendorApproveEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Event;
use App\Models\Wordprice;
use App\Models\Lottery;
use App\Models\Order;
use App\Models\Movie;
use App\Models\Auction;
use App\Models\Vendor;
use App\Models\User;
use App\Models\Logoad;
use App\Models\Stall;
use App\Models\Ticket;
use App\Models\AuctionLog;
use App\Models\Entrepreneur;
use App\Models\Popupprice;
use App\Models\Goodiebag;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestApproveMail;
use App\Mail\StallApproveMail;
use App\Mail\StallDeclineMail;
use App\Models\Product;

class AdminController extends Controller
{
    function index()
    {
        if (Auth::user()->permission == 3) {
            return view('admin.index', [
                'events' => Event::where('status', 'live')->get(),
            ]);
        } else {
            return redirect()->back();
        }
    }

    function getVendor()
    {
        if (Auth::user()->permission == 3) {
            return response()->json(['users' => User::where('permission', 2)->get()]);
        } else {
            return redirect()->back();
        }
    }

    function vendorStallAssign(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $stall = Stall::find($request->stall_id);
            $stall->assign_vendor_id = $request->vendor_id;
            $stall->save();
            return back()->with('success', 'Assign successfully!');
        } else {
            return redirect()->back();
        }
    }
    function vendorMovieAssign(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $movie = Movie::find($request->movie_id);
            $movie->assign_vendor_id = $request->vendor_id;
            $movie->save();
            return back()->with('success', 'Assign successfully!');
        } else {
            return redirect()->back();
        }
    }

    function events(Request $request)
    {
        if (Auth::user()->permission == 3) {
            return view('admin.events', [
                'events' => Event::all(),
                'filter' => $request->input("filter")
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function eventStalls($eventId)
    {
        if (Auth::user()->permission == 3) {
            $event = Event::findOrFail($eventId);
            $vendors = Vendor::all();

            // Get existing assignments
            $stalls = Stall::where('eventID', $eventId)
                ->get();
            return view('admin.event-stalls', [
                'event' => $event,
                'vendors' => $vendors,
                'stalls' => $stalls,
                'vendors' => User::where('permission', 2)->get()
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function stallVisibility(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $stall = Stall::find($request->stall_id);

            // return $request;

            if ($request->visibility == 'verbergen') {
                $stall->visibility = 0;
                $stall->save();
                return redirect()->back();
            } else {
                $stall->visibility = 1;
                $stall->save();
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }


    public function movieStalls($eventId)
    {
        if (Auth::user()->permission == 3) {
            $event = Event::findOrFail($eventId);
            $vendors = Vendor::all();

            // Get existing assignments
            $movies = Movie::where('eventID', $eventId)
                ->get();
            return view('admin.event-movies', [
                'event' => $event,
                'vendors' => $vendors,
                'movies' => $movies,
                'vendors' => User::where('permission', 2)->get()
            ]);
        } else {
            return redirect()->back();
        }
    }

        public function movieVisibility(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $movie = Movie::find($request->movie_id);

            if ($request->visibility == 'verbergen') {
                $movie->visibility = 0;
                $movie->save();
                return redirect()->back();
            } else {
                $movie->visibility = 1;
                $movie->save();
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }


    public function productStalls($eventId)
    {
        if (Auth::user()->permission == 3) {
            $event = Event::findOrFail($eventId);
            $vendors = Vendor::where('eventID', $eventId)->pluck('id')->toArray();
            $products = Product::whereIn('vendorID', $vendors)->get();
            return view('admin.event-products', [
                'event' => $event,
                'products' => $products,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function eventMovies($eventId)
    {
        $event = Event::findOrFail($eventId);
        $vendors = Vendor::all();

        // Get existing movie assignments
        $movies = Movie::where('eventID', $eventId)
            ->orderBy('movie_number')
            ->get()
            ->keyBy('movie_number');

        return view('admin.event-movies', [
            'event' => $event,
            'vendors' => $vendors,
            'movies' => $movies,
            'total_movies' => $event->total_movies ?? 30 // Default to 30 if not set
        ]);
    }

    public function auctions(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $search = $request->input('search');
            $filter = $request->input('filter');
            $filter_event = $request->input('filter_event');
            $filter_vendor = $request->input('filter_vendor');

            $query = Auction::query();

            if ($filter_event) {
                $query->where('eventID', $filter_event);
            }
            if ($filter_vendor) {
                $query->where('vendorID', $filter_vendor);
            }

            // Apply search filter
            if ($search) {
                $query->where('name', 'like', "%{$search}%");
                // $users = User::where('first_name', 'like', '%' . $search . '%')
                // ->orWhere('last_name', 'like', '%' . $search . '%')
                // ->orWhere('email', 'like', '%' . $search . '%')
                // ->pluck('id')->toArray();

                // $query->where('name', 'like', "%{$search}%")->orWhereHas('getVendor', function($q) use($search, $users){
                //     $q->where('name', 'like', "%{$search}%")->orWhereIn('ownerID', $users);
                // });
            }

            // Apply archive filter
            if ($filter == "archive") {
                $query->where('status', 'archive');
            } else {
                $query->where('status', 'live');
            }

            return view('admin.auctions', [
                'auctions' => $query->get(),
                'events' => Event::all(),
                'logs' => AuctionLog::all()
            ]);
        } else {
            return redirect()->back();
        }
    }

    // function auctions(){
    //   if ( Auth::user()->permission == 3){
    //     return view('admin.auctions', [
    //       'auctions' => Auction::whereIn('status', ['live', 'archive'])->get(),
    //       'logs' => AuctionLog::all()
    //     ]);
    //   }
    //   else {
    //     return redirect()->back();
    //   }
    // }

    function showLog($id)
    {
        if (Auth::user()->permission == 3) {
            // dd(AuctionLog::where('auctionID', $id)->get());
            return view('admin.log', [
                'log' => AuctionLog::where('auctionID', $id)->first(),
            ]);
        } else {
            return redirect()->back();
        }
    }

    function orders(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $filter = $request->get('filter', 'tickets');
            $search = $request->get('search');
            $orders = Order::with(['event', 'product', 'vendor'])
                ->when($filter == 'tickets', function ($query) {
                    return $query->where('contents', 1);
                })
                ->when($filter == 'other', function ($query) {
                    return $query->where('contents', '!=', 1);
                })
                ->when($filter == 'archive', function ($query) {
                    return $query->where('status', 'archive');
                })
                ->when($search, function ($query) use ($search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('id', 'like', "%$search%")
                            ->orWhere('first_name', 'like', "%$search%")
                            ->orWhere('last_name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
                            ->orWhere('phone_number', 'like', "%$search%");
                    });
                })
                ->where('paid', 'paid')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return view('admin.purchases', [
                'orders' => $orders,
                'vendors' => Vendor::all(),
                'filter' => $request->input('filter')
            ]);
        } else {
            return redirect()->back();
        }
    }

    function archiveOrder($id)
    {
        if (Auth::user()->permission == 3) {
            $order = Order::find($id);
            $order->status = 'archive';
            $order->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function liveOrder($id)
    {
        if (Auth::user()->permission == 3) {
            $order = Order::find($id);
            $order->status = 'live';
            $order->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    // Bulk archive method
    function bulkArchiveOrders(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $orderIds = $request->input('order_ids', []);
            
            if (!empty($orderIds)) {
                Order::whereIn('id', $orderIds)->update(['status' => 'archive']);
                return redirect()->back()->with('success', count($orderIds) . ' order(s) successfully archived.');
            }
            
            return redirect()->back()->with('error', 'No orders selected.');
        } else {
            return redirect()->back();
        }
    }

    // Bulk live method
    function bulkLiveOrders(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $orderIds = $request->input('order_ids', []);
            
            if (!empty($orderIds)) {
                Order::whereIn('id', $orderIds)->update(['status' => 'live']);
                return redirect()->back()->with('success', count($orderIds) . ' order(s) successfully moved to live.');
            }
            
            return redirect()->back()->with('error', 'No orders selected.');
        } else {
            return redirect()->back();
        }
    }

    function accounts()
    {
        if (Auth::user()->permission == 3) {
            $search = request()->input('search');
            if ($search) {
                $users = User::where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('getVendor', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->get();
            } else {
                $users = User::all();
            }

            $vendor_approve_items = [
                "logo" => "Logo advertentie",
                "movie" => "Video plaatsen",
                "stall" => "Stall plaatsen",
                "auction" => "Veiling-items plaatsen",
                "goodiebag" => "Goodiebag Item aanbieden",
            ];


            return view('admin.users', [
                'orders' => Order::all(),
                'users' => $users,
                'events' => Event::all(),
                'vendors' => Vendor::all(),
                'vendor_approve_items' => $vendor_approve_items,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function goodiebag(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $status = $request->input('filter') == 'archive' ? 'archive' : 'live';

            $query = Goodiebag::with(['stall', 'vendor.user', 'event'])
                ->where('status', $status);

            $eventId = $request->input('filter-event');
            $selectedEvent = null;

            if ($eventId) {
                $query->where('eventID', $eventId);
                $selectedEvent = Event::find($eventId);
            }

            $goodiebags = $query->get();

            return view('admin.goodiebag', [
                'goodiebags' => $goodiebags,
                'events' => Event::all(),
                'selectedEvent' => $selectedEvent,
                'filter' => $request->input("filter")
            ]);
        } else {
            return redirect()->back();
        }
    }

    // function goodiebag(Request $request){
    //   if ( Auth::user()->permission == 3){
    //     $event_name = null;
    //     if($request->input('filter-event')){
    //       $goodiebags = Goodiebag::where('eventID', $request->input('filter-event'))->get();
    //       $event_name = Event::find($request->input('filter-event'))->name;
    //     }else{
    //       $goodiebags = Goodiebag::all();
    //     }
    //     return view('admin.goodiebag', [
    //       'goodiebags' => $goodiebags,
    //       'events' => Event::all(),
    //       'event_name' => $event_name,
    //       'filter' => $request->input("filter")
    //     ]);
    //   }
    //   else {
    //     return redirect()->back();
    //   }
    // }

    function deleteGoodiebag($id)
    {
        if (Auth::user()->permission == 3) {
            Goodiebag::find($id)->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function editGoodiebag($id)
    {
        if (Auth::user()->permission == 3) {
            return view('admin.edit-goodiebag', [
                'goodiebag' => Goodiebag::find($id)
            ]);
        } else {
            return redirect()->back();
        }
    }
    function setLiveGoodiebag($id)
    {
        if (Auth::user()->permission == 3) {
            $goodie = Goodiebag::find($id);
            $goodie->status = 'live';
            $goodie->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    function setArchiveGoodiebag($id)
    {
        if (Auth::user()->permission == 3) {
            $goodie = Goodiebag::find($id);
            $goodie->status = 'archive';
            $goodie->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function updateGoodiebag(Request $request, $id)
    {
        if (Auth::user()->permission == 3) {
            $goodiebag = Goodiebag::find($id);
            $goodiebag->contents = $request->input('contents');
            $goodiebag->description = $request->input('description');
            $goodiebag->stock = $request->input('stock');
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = Str::random(25) . "." . $file->extension();
                $file->move(public_path('uploads/goodiebag/logo'), $filename);
                $goodiebag->logo = $filename;
            }
            $goodiebag->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function deleteUser($id)
    {
        if (Auth::user()->permission == 3) {

            User::find($id)->delete();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function vendorUser($id)
    {
        if (Auth::user()->permission == 3) {

            $user = User::find($id);
            $user->permission = 2;
            $user->save();

            Vendor::create([
                'ownerID' => $id,
                'name'  => $user->first_name,
            ]);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function customerUser($id)
    {
        if (Auth::user()->permission == 3) {

            $user = User::find($id);
            $user->permission = 1;
            $user->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function deleteEvent($id)
    {
        if (Auth::user()->permission == 3) {


            Logoad::where('eventID', $id)->delete();
            Ticket::where('eventID', $id)->delete();
            Lottery::where('eventID', $id)->delete();
            Wordprice::where('eventID', $id)->delete();
            Movie::where('eventID', $id)->delete();
            Stall::where('eventID', $id)->delete();
            Auction::where('eventID', $id)->delete();
            Popupprice::where('eventID', $id)->delete();

            Event::find($id)->delete();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function addEventForm()
    {
        if (Auth::user()->permission == 3) {

            return view('admin.new-event');
        } else {
            return redirect()->back();
        }
    }

    function archiveEvent($id)
    {
        if (Auth::user()->permission == 3) {
            $event = Event::find($id);
            $event->status = "archive";
            $event->save();
        }
        return redirect()->back();
    }

    function liveEvent($id)
    {
        if (Auth::user()->permission == 3) {
            $event = Event::find($id);
            $event->status = "live";
            $event->save();
        }
        return redirect()->back();
    }


    function addEvent(Request $request)
    {
        if (Auth::user()->permission == 3) {

            $request->validate([
                'desc' => 'required|max:255',
            ]);
            $event = new Event();
            $event->name = $request->input('name');
            $event->description = $request->input('desc');
            $event->information = $request->input('information');
            $event->price = $request->input('price');
            $event->max_tickets = $request->input('tickets');
            $event->start_date = $request->input('day');
            $event->end_date = $request->input('day');
            $event->start_time = $request->input('start-time');
            $event->end_time = $request->input('end-time');
            $event->auction_hall_closed = $request->input('auction_hall_closed') ? 1 : 0;
            $event->status = "live";
            // $event->auction_count = $request->input('auction_items');

            //Logo upload
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = Str::random(25) . "." . $file->extension();
                $file->move(public_path('uploads/event-s/logos'), $filename);
                $event->logo_url = $filename;
            }

            //Logo upload
            if ($request->file('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = Str::random(25) . "." . $file->extension();
                $file->move(public_path('uploads/event-s/thumbnails'), $filename);
                $event->thumbnail_url = $filename;
            }

            $event->save();

            $wordprice = new Wordprice();
            $wordprice->p1 = $request->input('wordprice');
            $wordprice->p2 = $request->input('wordprice2');
            $wordprice->p3 = $request->input('wordprice3');
            $wordprice->word = $request->input('word');
            $wordprice->release_time = $request->input('wordprice-reveal');
            $wordprice->p1_amount = $request->input('wordprice-winners');
            $wordprice->p2_amount = $request->input('wordprice-winners2');
            $wordprice->p3_amount = $request->input('wordprice-winners3');
            $wordprice->eventID = $event->id;

            $wordprice->participating_tickets = "";
            $wordprice->correct_tickets = "";
            $wordprice->winning_tickets = "";
            $wordprice->chance = 100.00;
            $wordprice->release_date = $request->input('day');
            $wordprice->save();

            $lottery = new Lottery();
            $lottery->price_name = $request->input('lottery');
            $lottery->release_time = $request->input('lottery-reveal');
            $lottery->price_amount = $request->input('lottery-winners');
            $lottery->eventID = $event->id;

            $lottery->winning_tickets = "";
            $lottery->chance = 100.00;
            $lottery->release_date = $request->input('day');
            $lottery->save();

            return redirect('admin/events');
        } else {
            return redirect()->back();
        }
    }

    function updateEventForm($id)
    {
        if (Auth::user()->permission == 3) {
            $event = Event::find($id);
            $wordprice = Wordprice::where('eventID', $id)->first();
            $lottery = Lottery::where('eventID', $id)->first();
            $popup = Popupprice::where('eventID', $id)->first();

            return view('admin.edit-event', [
                "eventID" => $id,
                "event_name" => $event->name,
                "event_description" => $event->description,
                "event_information" => $event->information,
                "event_logo_url" => $event->logo_url,
                "event_thumbnail_url" => $event->thumbnail_url,
                "ticket_price" => $event->price,
                //   "auction_items" => $event->auction_count,
                "max_tickets" => $event->max_tickets,
                "date" => $event->start_date,
                "start_time" => $event->start_time,
                "end_time" => $event->end_time,
                "auction_hall_closed" => $event->auction_hall_closed,
                "wordprice" => $wordprice->p1 ?? '',
                "wordprice2" => $wordprice->p2 ?? '',
                "wordprice3" => $wordprice->p3 ?? '',
                "word" => $wordprice->word ?? '',
                "wordprice_reveal" => $wordprice->release_time ?? '',
                "wordprice_winners" => $wordprice->p1_amount ?? '',
                "wordprice_winners2" => $wordprice->p2_amount ?? '',
                "wordprice_winners3" => $wordprice->p3_amount ?? '',
                "woordprice_image" => $wordprice->image ?? '',
                "lottery" => $lottery->price_name,
                "lottery_reveal" => $lottery->release_time,
                "lottery_winners" => $lottery->price_amount,
                "loterij_image" => $lottery->image,
                "popup_name" => $popup->price_name ?? "",
                "popup_contents" => $popup->contents ?? ''
            ]);
        } else {
            return redirect()->back();
        }
    }

    function prices()
    {
        if (Auth::user()->permission == 3) {
            $popup = Popupprice::all();
            return view('admin.prices', [
                "popup_prices" => $popup,
                "events" => Event::all()
            ]);
        } else {
            return redirect()->back();
        }
    }

    function deletePopUpPrice($id)
    {
        if (Auth::user()->permission == 3) {
            $popup = Popupprice::find($id);
            $popup->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function updatePopUpPriceForm($id)
    {
        if (Auth::user()->permission == 3) {
            $popup = Popupprice::find($id);
            return view('admin.edit-popup', [
                "popup" => $popup,
                "events" => Event::whereStatus('live')->get()
            ]);
        } else {
            return redirect()->back();
        }
    }

    function updatePopUpPrice(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $popup = Popupprice::find($request->input('id'));
            $popup->stock = $request->input('stock');
            $popup->contents = $request->input('contents');
            $popup->price_name = $request->input('name');
            $popup->eventID = $request->input('eventID');
            $popup->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function addPopUpForm()
    {
        if (Auth::user()->permission == 3) {
            return view('admin.new-popup', [
                "events" => Event::whereStatus('live')->get()
            ]);
        } else {
            return redirect()->back();
        }
    }

    function addGoodiebagForm()
    {
        if (Auth::user()->permission == 3) {
            return view('admin.new-goodiebag', [
                "events" => Event::where('status', 'live')->get(),
            ]);
        } else {
            return redirect()->back();
        }
    }

    function addPopUp(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $popup = new Popupprice();
            $popup->stock = $request->input('stock');
            $popup->contents = $request->input('contents');
            $popup->price_name = $request->input('name');
            $popup->chance = $request->input('chance');
            $popup->eventID = $request->input('eventID');
            $popup->claimed_by = "";
            $popup->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function addGoodiebag(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $goodiebag = new Goodiebag();
            $goodiebag->contents = $request->input('contents');
            $goodiebag->description = $request->input('description');
            $goodiebag->stock = $request->input('stock');
            $goodiebag->status = "live";
            $goodiebag->eventID = $request->input('eventID');
            $goodiebag->vendor_id = $request->input('vendorID');
            if ($request->input('vendorID')) {
                $stall = Stall::where('vendorID', $request->input('vendorID'))->first();
                if ($stall) {
                    $goodiebag->stallID = $stall->id;
                }
            }

            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = Str::random(25) . "." . $file->extension();
                $file->move(public_path('uploads/goodiebag/logo'), $filename);
                $goodiebag->logo = $filename;
            }
            $goodiebag->save();
            return redirect('admin/goodiebag');
        } else {
            return redirect()->back();
        }
    }

    public function adminGoodiebagEventChange(Request $request)
    {
        $event = Event::find($request->event_id);
        if ($event) {
            $vendors = $event->getVendors()->doesntHave('goodiebag')->get();
            $view = view('admin.event-vendor', compact('vendors'))->render();
            return response($view);
        } else {
            return response('<option value="">Kies vendor..</option>');
        }
    }

    public function eventChangeVendor(Request $request)
    {
        $event = Event::find($request->event);
        if ($event) {
            $vendors = $event->getVendors;
            $view = view('admin.event-vendor-', compact('vendors'))->render();
            return response($view);
        } else {
            return response('<option value="">Selecteer vendor</option>');
        }
    }

    function updateEvent(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $event = Event::find($request->input('eventID'));
            $event->name = $request->input('name');
            $event->description = $request->input('desc');
            $event->information = $request->input('information');
            $event->price = $request->input('price');
            $event->max_tickets = $request->input('tickets');
            $event->start_date = $request->input('day');
            $event->end_date = $request->input('day');
            $event->start_time = $request->input('start-time');
            $event->end_time = $request->input('end-time');
            $event->auction_hall_closed = $request->input('auction_hall_closed') ? 1 : 0;
            // $event->auction_count = $request->input('auction_items');

            // $vendor_auction = Auction::where('vendorID', Vendor::where('eventID', $event->id)->first()->id)->count();
            // $auction_count = $request->input('auction_items') - $vendor_auction;
            // Vendor::where('eventID', $event->id)->update(['auction_item_count' => $auction_count]);

            //Logo upload
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = Str::random(25) . "." . $file->extension();
                $file->move(public_path('uploads/event-s/logos'), $filename);
                $event->logo_url = $filename;
            }

            //Logo upload
            if ($request->file('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = Str::random(25) . "." . $file->extension();
                $file->move(public_path('uploads/event-s/thumbnails'), $filename);
                $event->thumbnail_url = $filename;
            }

            $event->save();
            $wordprice = Wordprice::where('eventID', $event->id)->first();
            if (!$wordprice) {
                $wordprice = new Wordprice();
            }
            $wordprice->p1 = $request->input('wordprice');
            $wordprice->p2 = $request->input('wordprice2');
            $wordprice->p3 = $request->input('wordprice3');
            $wordprice->word = $request->input('word');
            $wordprice->release_time = $request->input('wordprice-reveal');
            $wordprice->release_date = $request->input('day');
            $wordprice->p1_amount = $request->input('wordprice-winners');
            $wordprice->p2_amount = $request->input('wordprice-winners2');
            $wordprice->p3_amount = $request->input('wordprice-winners3');

            if ($request->file('woordprice_image')) {
                $file = $request->file('woordprice_image');
                $filename = Str::random(25) . "." . $file->extension();
                $file->move(public_path('uploads/event-s/woordprice_images'), $filename);
                $wordprice->image = $filename;
            }

            $wordprice->save();

            $lottery = Lottery::where('eventID', $event->id)->first();
            if (!$lottery) {
                $lottery = new Lottery();
            }
            $lottery->price_name = $request->input('lottery');
            $lottery->release_time = $request->input('lottery-reveal');
            $lottery->price_amount = $request->input('lottery-winners');
            $lottery->release_date = $request->input('day');

            if ($request->file('loterij_image')) {
                $file = $request->file('loterij_image');
                $filename = Str::random(25) . "." . $file->extension();
                $file->move(public_path('uploads/event-s/loterij_images'), $filename);
                $lottery->image = $filename;
            }

            $lottery->save();

            return redirect('admin/events');
        } else {
            return redirect()->back();
        }
    }

    public function approvals(Request $request)
    {
        if (Auth::user()->permission == 3) {
            // Get search term
            $searchTerm = $request->input('search');

            // Base queries
            $movieQuery = Movie::query();
            $logoQuery = Logoad::query();
            $auctionQuery = Auction::query();
            $stallQuery = Stall::query();
            // $stallQuery = Stall::where('enabled', 0)->where('request', 1);
            $vendorQuery = Vendor::query();

            // Apply search term if provided
            if ($searchTerm) {
                $movieQuery->where('video_name', 'like', "%{$searchTerm}%")->orWhereHas('getVendor', function ($mq) use ($searchTerm) {
                    $mq->where('name', 'like', "%{$searchTerm}%");
                });
                $logoQuery->where('redirect_url', 'like', "%{$searchTerm}%")->orWhereHas('getVendor', function ($mq) use ($searchTerm) {
                    $mq->where('name', 'like', "%{$searchTerm}%");
                });
                $auctionQuery->where('name', 'like', "%{$searchTerm}%")->orWhereHas('getVendor', function ($mq) use ($searchTerm) {
                    $mq->where('name', 'like', "%{$searchTerm}%");
                });
                $stallQuery->where('description', 'like', "%{$searchTerm}%")->orWhereHas('vendor', function ($mq) use ($searchTerm) {
                    $mq->where('name', 'like', "%{$searchTerm}%");
                });
                $vendorQuery->where('name', 'like', "%{$searchTerm}%");
            }

            // Get results
            $movies = $movieQuery->where('enabled', 0)->get();
            $logos = $logoQuery->where('enabled', 0)->get();
            $auctions = $auctionQuery->where('status', 'awaiting_approval')->get();
            $stalls = $stallQuery->where('enabled', 0)->get();
            $awaiting_vendors = $vendorQuery->where('enabled', 0)->get();
            $vendor_approve_items = [
                "logo" => "Logo advertentie",
                "movie" => "Video plaatsen",
                "stall" => "Stall plaatsen",
                "auction" => "Veiling-items plaatsen",
                "goodiebag" => "Goodiebag Item aanbieden",
            ];

            return view('admin.approve', [
                'events' => Event::all(),
                'vendors' => Vendor::all(),
                'movies' => $movies,
                'logos' => $logos,
                'auctions' => $auctions,
                'stalls' => $stalls,
                'awaiting_vendors' => $awaiting_vendors,
                'vendor_approve_items' => $vendor_approve_items,
                'users' => User::all()
            ]);
        } else {
            return redirect()->back();
        }
    }

    // function approvals(Request $request){
    //   if ( Auth::user()->permission == 3){

    //     // Filter by vendor
    //     $filter = $request->input('filter-vendor');
    //     if($filter){
    //       $movies = Movie::where('enabled', 0)->where('vendorID', $filter)->get();
    //       $logos = Logoad::where('enabled', 0)->where('vendorID', $filter)->get();
    //       $auctions = Auction::where('status', 'awaiting_approval')->where('vendorID', $filter)->get();
    //       $stalls = Stall::where('enabled', 0)->where('request', 1)->where('vendorID', $filter)->get();
    //       $awaiting_vendors = Vendor::where('id', $filter)->where('enabled', 0)->get();
    //     }else{
    //       $movies = Movie::where('enabled', 0)->get();
    //       $logos = Logoad::where('enabled', 0)->get();
    //       $auctions = Auction::where('status', 'awaiting_approval')->get();
    //       $stalls = Stall::where('enabled', 0)->where('request', 1)->get();
    //       $awaiting_vendors = Vendor::where('enabled', 0)->get();
    //     }

    //     return view('admin.approve', [
    //       'events' => Event::all(),
    //       'vendors' => Vendor::all(),
    //       'movies' => $movies,
    //       'logos' => $logos,
    //       'auctions' => $auctions,
    //       'stalls' => $stalls,
    //       'awaiting_vendors' => $awaiting_vendors,
    //       'users' => User::all()

    //     ]);
    //   }
    //   else {
    //     return redirect()->back();
    //   }
    // }

    function permissions($id)
    {
        if (Auth::user()->permission == 3) {
            return view('admin.permissions', [
                'vendor' => Vendor::where('ownerID', $id)->first()

            ]);
        } else {
            return redirect()->back();
        }
    }

    function vendorApprove($id)
    {
        if (Auth::user()->permission == 3) {

            $vendor = vendor::find($id);
            $vendor->enabled = 1;
            $user = User::find($vendor->ownerID);
            if ($user) {
                $user->permission = 2;
                $email = $user->email;
                $user->save();
                if ($email) {
                    Mail::to($email)->send(new VendorApproveEmail($user->first_name));
                }
            }
            $vendor->save();



            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function vendorSave(Request $request, $id)
    {
        if (Auth::user()->permission == 3) {
            $permissions = "";
            $vendor = Vendor::where('ownerID', $id)->first();
            // Sending mail after first approve.
            if (!str_contains($vendor->permissions, 'approved')) {
                Mail::to($vendor->user?->email)->send(new VendorApproveEmail($vendor->user?->first_name));
            }

            if ($request->input('logo')) $permissions .= ",logo";
            if ($request->input('movie')) $permissions .= ",movie";
            if ($request->input('stall')) $permissions .= ",stall";
            if ($request->input('auction')) $permissions .= ",auction";
            if ($request->input('goodiebag')) $permissions .= ",goodiebag";
            // Set a value for permission approved.
            $permissions .= ",approved";
            $vendor->permissions = $permissions;
            $vendor->save();
            return redirect(url('/') . '/admin/accounts');
        } else {
            return redirect()->back();
        }
    }

    function vendorDecline($id)
    {
        if (Auth::user()->permission == 3) {

            $vendor = Vendor::find($id);
            $user = User::find($vendor->ownerID);
            $user->delete();
            $vendor->delete();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function movieApprove($id)
    {
        if (Auth::user()->permission == 3) {

            $movie = Movie::find($id);
            $movie->enabled = true;
            $movie->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    function logoApprove($id)
    {
        if (Auth::user()->permission == 3) {

            $logo = Logoad::find($id);
            $logo->enabled = true;
            $logo->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function auctionSettings($id)
    {
        return view('admin.auctionSettings', [
            'auction' => Auction::find($id)
        ]);
    }

    function auctionApprove($id, Request $request)
    {
        if (Auth::user()->permission == 3) {

            $auction = Auction::find($id);
            // $auction->start_time = $request->input('start_time');
            // $auction->end_time = $request->input('end_time');
            $auction->status = "live";
            $auction->save();
            $vendorID = $auction->vendorID;
            $vendor = Vendor::find($vendorID);

            if ($vendor && !$vendor->pendingAuctionItem) {
                // $userID = $vendor->ownerID;
                $user = User::find($vendor->ownerID);
                // $vendor_name = $user?->first_name;
                // $data = [
                //   'type' => 'AuctionApprove',
                //   'name' => $auction->name,
                //   'username' => $user?->first_name
                // ];

                if ($user) {
                    Mail::to($user->email)->send(new AuctionNotificationMail($vendor));
                }
            }


            return redirect(url('/') . '/admin/approvals');
        } else {
            return redirect()->back();
        }
    }

    function updateAuctionTime(Request $request, $id)
    {
        if (Auth::user()->permission == 3) {

            $auction = Auction::find($id);
            $auction->start_time = $request->input('start_time');
            $auction->end_time = $request->input('end_time');
            $auction->save();

            return redirect('admin/auctions');
        } else {
            return redirect()->back();
        }
    }

    function auctionArchive($id)
    {
        if (Auth::user()->permission == 3) {

            $auction = Auction::find($id);
            $auction->status = $auction->status == 'archive' ? 'live' : 'archive';
            $auction->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function auctionDecline($id)
    {
        if (Auth::user()->permission == 3) {

            $auction = Auction::find($id);
            $vendorID = $auction->vendorID;
            $vendor = Vendor::find($vendorID);
            $userID = $vendor->ownerID ?? null;
            $user = User::find($userID);
            // $data = [
            //   'type' => 'AuctionDecline',
            //   'name' => $auction->name,
            //   'username' => $user->first_name ?? null
            // ];
            // Mail::to($user->email)->send(new RequestApproveMail($data));
            $auction->status = "archive";
            $auction->save();
            // $auction->delete();

            if ($user && $vendor && !$vendor->pendingAuctionItem) {
                // $userID = $vendor->ownerID;
                $user = User::find($vendor->ownerID);

                if ($user) {
                    Mail::to($user->email)->send(new AuctionNotificationMail($vendor));
                }
            }

            // if($vendor && !$vendor->pendingAuctionItem){
            //     if($user?->email){
            //         Mail::to($user->email)->send(new RequestApproveMail($data));
            //     }
            // }

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function stallApprove($id)
    {
        if (Auth::user()->permission == 3) {
            $stall = Stall::find($id);
            if ($stall) {
                $stall->enabled = 1;
                $stall->save();
                // $data = [
                //   'type' => 'StallApprove',
                //   'username' => User::find(Vendor::find($stall->vendorID)->ownerID)->first_name ?? "",
                // ];
                // Mail::to(User::find(Vendor::find($stall->vendorID)->ownerID)->email)->send(new RequestApproveMail($data));
                if ($stall->vendor && $stall->vendor->user) {
                    Mail::to($stall->vendor->user->email)->send(new StallApproveMail($stall->vendor->user->first_name));
                }
            }
            return redirect('admin/approvals');
        } else {
            return redirect()->back();
        }
    }

    function stallDecline($id)
    {
        if (Auth::user()->permission == 3) {

            $stall = Stall::find($id);
            // $data = [
            //   'type' => 'StallDecline',
            //   'username' => User::find(Vendor::find($stall->vendorID)->ownerID)->first_name ?? "",
            // ];
            // Mail::to(User::find(Vendor::find($stall->vendorID)->ownerID)->email)->send(new RequestApproveMail($data));
            // $stall->enabled = 2;
            // $stall->save();


            if ($stall) {
                $stall->enabled = 2;
                $stall->save();
                if ($stall->vendor && $stall->vendor->user) {
                    Mail::to($stall->vendor->user->email)->send(new StallDeclineMail($stall->vendor->user->first_name));
                }
            }



            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function movieDecline($id)
    {
        if (Auth::user()->permission == 3) {

            $movie = Movie::find($id);
            $movie->delete();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    function logoDecline($id)
    {
        if (Auth::user()->permission == 3) {

            $movie = Logoad::find($id);
            $movie->delete();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function ondernemer(Request $request)
    {
        if (Auth::user()->permission == 3) {
            $items = Entrepreneur::all();
            // dd($items);
            return view('admin.ondernemer', [
                "items" => $items,
                'filter' => $request->input("filter")
            ]);
        } else {
            return redirect()->back();
        }
    }

    function archiveOndernemer($id)
    {
        if (Auth::user()->permission == 3) {
            $entrepreneur = Entrepreneur::find($id);
            $entrepreneur->status = "archive";
            $entrepreneur->save();
        }
        return redirect()->back();
    }

    function deleteOndernemer($id)
    {
        if (Auth::user()->permission == 3) {
            Entrepreneur::find($id)->delete();
            return redirect()->back();
        }
        return redirect()->back();
    }

    function liveOndernemer($id)
    {
        if (Auth::user()->permission == 3) {
            $entrepreneur = Entrepreneur::find($id);
            $entrepreneur->status = "live";
            $entrepreneur->save();
        }
        return redirect()->back();
    }

    function returnAndCancel(Request $request)
    {
        dd($request->all());
    }
}
