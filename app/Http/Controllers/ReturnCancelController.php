<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\ReturnRequest;
use App\Models\CancelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReturnRequestMail;
use App\Mail\CancelRequestMail;
use App\Mail\CancelVendorMail;
use App\Mail\ReturnVendorMail;
use App\Models\Vendor;
use App\Models\VendorAccessedCancelRequest;
use App\Models\VendorAccessedReturnRequest;
use Illuminate\Support\Facades\Mail;

class ReturnCancelController extends Controller
{
    public function retour(){
        $orders = Order::where('paid_by', Auth::id())->where('cancel_status', 0)->where('return_status', 0)->get();
        return view('Formulieren.retour', compact('orders'));
    }

    public function annulering(){
        $orders = Order::where('paid_by', Auth::id())->where('cancel_status', 0)->where('return_status', 0)->get();
        return view('Formulieren.annulering', compact('orders'));
    }

    public function returnRequest(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_phone_number' => 'required|string|max:20',
            'order_number' => 'required|string|max:50',
            'item_description' => 'required|string',
            'return_item' => 'required|integer|min:1',
            'return_reason' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Order::find($data['order_number'])->update([
            'return_status' => 1,
        ]);

        // Uncomment the following lines if you want to restrict return requests to the user's own orders
        // if(Order::where('paid_by', auth()->id())
        //     ->where('id', $data['order_number'])
        //     ->doesntExist()) {
        //     return back()->withErrors(['order_number' => 'U kunt alleen retouraanvragen indienen voor uw eigen bestellingen.']);
        // }

        $return =  ReturnRequest::create([
            'user_id' => auth()->id(),
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'tel_number' => $data['contact_phone_number'],
            'order_number' => $data['order_number'],
            'description' => $data['item_description'],
            'quantity' => $data['return_item'],
            'reason' => $data['return_reason'],
            'comment' => $data['message'],
        ]);

        $admin = User::where('permission', 3)->first();
        Mail::to($admin->email)->send(new ReturnRequestMail($return));

        return back()->with('success', 'Retouraanvraag succesvol ingediend!');
    }

    public function adminReturnList(){
        if(request()->has('search')) {
            $search = request()->input('search');
            $returnRequests = ReturnRequest::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('order_number', 'like', "%{$search}%")
                ->get();
        } else {
            $search = '';
            $returnRequests = ReturnRequest::all();
        }
        return view('Formulieren.return_requests', compact('returnRequests'));
    }

    public function getVendorsOfThisEventForReturn()
    {
        $eventId = $_GET['id'];
        $returnId = $_GET['return_id'];
        $vendors = Vendor::where('eventID', $eventId)->get();

        return response()->json(['vendors' => $vendors, 'returnId' =>   $returnId]);
    }

    public function forwardVendorReturnReq(Request $request)
    {
       if(Auth::user()->permission == 3)
       {
         $vendor_return_request = new VendorAccessedReturnRequest();
        $vendor_return_request->user_id = $request->user_id;
        $vendor_return_request->return_id = $request->return_id;
        $vendor_return_request->save();

        $return = ReturnRequest::find($request->return_id);
        $user = User::find($request->user_id);
        $vendor_name = $user->first_name . ' ' . $user->last_name;

        Mail::to($user->email)->send(new ReturnVendorMail($vendor_name, $return));

        return redirect()->back();
       }
       else{ return redirect()->back();}
    }

    public function userReturnList()
    {
        $returnRequests = ReturnRequest::where('user_id', auth()->id())->get();

        return view('Formulieren.user.returnRequests', compact('returnRequests'));
    }

    public function vendorReturnList()
    {
        $ownReturnRequests = ReturnRequest::where('user_id', auth()->id())->get();
        $sharedReturnRequests = auth()->user()->accessedReturnRequests;
        $allReturnRequests = $ownReturnRequests->merge($sharedReturnRequests);
        return view('Formulieren.vendor.returnRequests', compact('allReturnRequests'));
    }

    public function cancelRequest(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_phone_number' => 'required|string|max:20',
            'order_number' => 'required|string|max:50',
            'message' => 'required|string',
        ]);

        Order::find($data['order_number'])->update([
            'cancel_status' => 1,
        ]);


        $cancel = CancelRequest::create([
            'user_id' => auth()->id(),
            'name' => $data['first_name']. ' ' . $data['last_name'],
            'email' => $data['email'],
            'tel_number' => $data['contact_phone_number'],
            'order_number' => $data['order_number'],
            'note' => $data['message'],
        ]);

        $admin = User::where('permission', 3)->first();
        Mail::to($admin->email)->send(new CancelRequestMail($cancel));

        return back()->with('success', 'Annuleringsverzoek succesvol verzonden!');
    }

    public function adminCancelRequest()
    {
        if (request()->has('search')) {
            $search = request()->input('search');
            $cancelRequests = CancelRequest::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('order_number', 'like', "%{$search}%")
                ->get();
        } else {
            $search = '';
            $cancelRequests = CancelRequest::all();
        }
        return view('Formulieren.cancel_requests', compact('cancelRequests'));
    }
        public function getVendorsOfThisEventForCancel()
    {
        $eventId = $_GET['id'];
        $cancelId = $_GET['cancel_id'];
        $vendors = Vendor::where('eventID', $eventId)->get();

        return response()->json(['vendors' => $vendors, 'cancelId' =>   $cancelId]);
    }

      public function forwardVendorCancelReq(Request $request)
    {
        if(Auth::user()->permission == 3)
        {
            $vendor_cancel_request = new VendorAccessedCancelRequest();
        $vendor_cancel_request->user_id = $request->user_id;
        $vendor_cancel_request->cancel_id = $request->cancel_id;
        $vendor_cancel_request->save();

        $cancel = CancelRequest::find($request->cancel_id);
        $user = User::find($request->user_id);
        $vendor_name = $user->first_name . ' ' . $user->last_name;

        Mail::to($user->email)->send(new CancelVendorMail($vendor_name, $cancel));

        return redirect()->back();
        }
        else{ return redirect()->back();}

    }

    public function userCancelRequest()
    {
        $cancelRequests = CancelRequest::where('user_id', auth()->id())->get();
        return view('Formulieren.user.cancelRequests', compact('cancelRequests'));
    }

    public function vendorCancelRequest()
    {
        $cancelRequests = CancelRequest::where('user_id', auth()->id())->get();
        return view('Formulieren.vendor.cancelRequests', compact('cancelRequests'));
    }

       public function vendorCancelList()
    {

        $ownCancelRequests = CancelRequest::where('user_id', auth()->id())->get();

        $sharedReturnRequests = auth()->user()->accessedCancelRequests;

        $allCancelRequests = $ownCancelRequests->merge($sharedReturnRequests);


        return view('Formulieren.vendor.cancelRequests', compact('allCancelRequests'));
    }
}
