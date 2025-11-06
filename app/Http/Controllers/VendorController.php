<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\Event;
use App\Models\Stall;
use App\Models\Auction;
use App\Models\Movie;
use App\Models\Vendor;
use App\Models\Logoad;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Goodiebag;
use App\Mail\AuctionNotificationMail;
use App\Models\Order;
use App\Models\ProductImage;
use App\Models\ProductSize;

class VendorController extends Controller
{

    function logoAd(Request $request){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2 && empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first()) && str_contains($vendorPerms, 'logo')){
        $events = Event::all();
        if(!empty($request->input('send'))){
          if($request->input('send') == "success") return view('vendor.logo.index', ['events' => $events, 'message' => 'Logo advertentie is succesvol geregistreerd!']);
        }
        return view('vendor.logo.index', [
          'events' => $events,
          'vendor_perms' => $vendorPerms,
          'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first()),
          'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first())

        ]);
      }
      else return redirect()->back();
    }

    function addlogoAd(Request $request){
        $request->validate([
            'logo' => 'dimensions:width=210,height=140'
        ], [
            'logo.dimensions' => 'Het logo moet 210px breed en 140px hoog zijn'
        ]);
      if(Auth::user()->permission == 2){
        $logoAd = new Logoad();
        $logoAd->redirect_url = $request->input('redirect_url') ?? '#';
        $logoAd->eventID = Vendor::where('ownerID', Auth::user()->id)->first()->eventID;
        $logoAd->vendorID = Vendor::where('ownerID', Auth::user()->id)->first()->id;

        //logo uploads
        if($request->file('logo')){
            $file= $request->file('logo');
            $filename= Str::random(25).".".$file->extension();
            $file->move(public_path('uploads/vendor/logoad'), $filename);
            $logoAd->logo_url= $filename;
        }

        $logoAd->clicks = 0;
        $logoAd->enabled = 0;
        $logoAd->save();

        return redirect(url('/') . '/vendor')->with('success', 'Logo succesvol toegevoegd.');
      }
      else return redirect()->back();
    }

    function movie(Request $request){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2 && empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()) && str_contains($vendorPerms, 'movie')){
        $events = Event::all();
        if(!empty($request->input('send'))){
          if($request->input('send') == "success") return view('vendor.movie.index', ['events' => $events, 'message' => 'Movie is succesvol aangevraagd!']);
        }
        return view('vendor.movie.index', [
          'events' => $events,
          'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'vendor_perms' => $vendorPerms
        ]);
      }
      else return redirect()->back();
    }

    function addMovie(Request $request){
      if(Auth::user()->permission == 2){
        $movie = new Movie();
        $movie->video_url = $request->input('video_url');
        $movie->video_name = $request->input('name');
        $movie->eventID = Vendor::where('ownerID', Auth::user()->id)->first()->eventID;
        $movie->vendorID = Vendor::where('ownerID', Auth::user()->id)->first()->id;

        $movie->enabled = 0;
        $movie->clicks = 0;

        //thumbnail uploads
        if($request->file('thumbnail')){
            $file= $request->file('thumbnail');
            $filename= Str::random(25).".".$file->extension();
            $file-> move(public_path('uploads/vendor/mvtmb'), $filename);
            $movie->thumbnail_url= $filename;
        }
        $movie->save();

        return redirect(url('/') . '/vendor')->with('success', 'Movie succesvol toegevoegd.');
      }
      else return redirect()->back();
    }

    function stall(Request $request){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2 && str_contains($vendorPerms, 'stall')){
        $events = Event::all();
        $products = Product::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->with('productSize')->get();
        $coupons = Coupon::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->get();
        if(!empty($request->input('send'))){
          if($request->input('send') == "success") return view('vendor.stall.index', ['events' => $events, 'products' => $products, 'message' => 'Stall is succesvol aangevraagd!']);
        }
        if (!empty(Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first())) {
          $goodiebag = Goodiebag::where('stallID', Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first()->id ?? null)->first();
          $stallExists = true;
        }
        else {
          $goodiebag = null;
          $stallExists = false;
        }

        $stall = '';
        $logoAd = '';
        $movie = '';
        return view('vendor.stall.index', [
          'events' => $events,
          'products' => $products,
          'coupons' => $coupons,
          'stall' => Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first(),
          'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'vendor_perms' => $vendorPerms,
          'goodiebag' => $goodiebag,
          'stall_exists' => $stallExists
        ]);
      }
      else return redirect()->back();
    }

    public function stallEdit(){
      $vendor_perms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      $stall = Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first();
      $logoAd = empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first());
      $movie = empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first());
      return view('vendor.stall.edit', compact('stall', 'vendor_perms', 'logoAd', 'movie'));
    }
    public function stallResend(){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first();
      if($vendorPerms && Auth::user()->permission == 2 && str_contains($vendorPerms->permissions ?? '', 'stall')){
          if($vendorPerms->stall && $vendorPerms->stall->enabled == 2){
            $vendorPerms->stall->update([
                'enabled' => 0
            ]);
            return back()->with('success', 'Stall succesvol opnieuw verzonden');
          }
      }
     return back();
    }

    public function stallUpdate(Request $request){
      if (Auth::user()->permission == 2){
        $stall = Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first();
        $stall->description = $request->input('description');
        $stall->shipping_cost = $request->input('shipping_cost');
        $stall->free_shipping_above = $request->input('free_shipping_above') ?? null;
        //logo uploads
        if($request->file('logo')){
            $file= $request->file('logo');
            $filename= Str::random(25).".".$file->extension();
            $file-> move(public_path('uploads/stalls/logo'), $filename);
            $stall->logo_url= $filename;
        }
        $stall->enabled = 0;
        $stall->save();

        return redirect(url('/') . '/vendor/request-stall')->with('success', 'Stall succesvol bijgewerkt.');
      }
      return back();
    }

    public function sendStallRequest(Request $request){
      if (Auth::user()->permission == 2){
        $data = json_decode(request()->query('data'), true);
        $stall = Stall::find($data['id']);
        $stall->request = true;
        $stall->save();

        return redirect(url('/') . '/vendor');
      }
      return back();
    }

    function goodiebag(){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){
        return view('vendor.stall.new-goodiebag',[
          'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'goodiebag' => Goodiebag::where('stallID', Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first()->id ?? null)->first() ?? '',
          'stallID' => Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()->id ?? '',
          'vendor_perms' => $vendorPerms
        ]);
      }
      else return redirect()->back();
    }

    function setGoodiebag(Request $request){
      $vendor = Vendor::where('ownerID', Auth::user()->id)->first();
      $vendorPerms = $vendor->permissions;
      if(Auth::user()->permission == 2 && str_contains($vendorPerms, 'stall')){
        $stallID = $request->input('stallID');
        if(!empty(Goodiebag::where('stallID', $stallID)->first())) $goodiebag = Goodiebag::where('stallID', $stallID)->first();
        else $goodiebag = new Goodiebag();
        if($stallID){
          $goodiebag->stallID = $stallID;
        }
        $goodiebag->status = 'live';
        $goodiebag->contents = $request->input('contents');
        $goodiebag->description = $request->input('description');
        $goodiebag->stock = $request->input('stock');
        $goodiebag->eventID = $vendor->eventID;
        $goodiebag->vendor_id = $vendor->id;
        if($request->file('logo')){
          $file= $request->file('logo');
          $filename= Str::random(25).".".$file->extension();
          $file-> move(public_path('uploads/goodiebag/logo'), $filename);
          $goodiebag->logo = $filename;
      }
        $goodiebag->save();
        return redirect(url('/') . '/vendor')->with('success', 'Goodiebag succesvol toegevoegd.');
      }
      else return redirect()->back();

    }

    function addStall(Request $request){
      if (Auth::user()->permission == 2){
        $stall = new Stall();
        $stall->description = $request->input('description');
        $stall->eventID = Vendor::where('ownerID', Auth::user()->id)->first()->eventID;
        $stall->vendorID = Vendor::where('ownerID', Auth::user()->id)->first()->id;
        //logo uploads
        if($request->file('logo')){
            $file= $request->file('logo');
            $filename= Str::random(25).".".$file->extension();
            $file-> move(public_path('uploads/stalls/logo'), $filename);
            $stall->logo_url = $filename;
        }
        $stall->thumbnail_url = "";
        $stall->enabled = 0;

        $stall->free_shipping_above = $request->free_shipping_above ?? null;
        $stall->shipping_cost = $request->shipping_cost ?? null;

        $stall->save();

        return redirect(url('/') . '/vendor/request-stall')->with('success', 'Stall succesvol toegevoegd.');
      }
    }

    function setStallSampleInfo(Request $request){
      if (Auth::user()->permission == 2){
        $stall = Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first();
        $stall->sample_contents = $request->input('sample_contents');
        $stall->sample_stock = $request->input('sample_stock');
        if($request->file('sample_logo')){
          $file= $request->file('sample_logo');
          $filename= Str::random(25).".".$file->extension();
          $file-> move(public_path('uploads/stalls/sample-logo'), $filename);
          $stall->sample_logo = $filename;
        }
        else{
          $stall->sample_logo = null;
        }
        $stall->save();

        return redirect(url('/') . '/vendor/request-stall')->with('success', 'Sample succesvol bijgewerkt');
      }
      return back();
    }

    function newProduct(){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){
        return view('vendor.stall.new-product',[
          'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'vendor_perms' => $vendorPerms
        ]);
      }
      else return redirect()->back();
    }

    function newCoupon(){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){
        return view('vendor.stall.new-coupon',[
          'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'vendor_perms' => $vendorPerms
        ]);
      }
      else return redirect()->back();
    }

    function coupon($id){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){
        $coupon = Coupon::find($id);
        return view('vendor.stall.coupon', [
          'coupon' => $coupon,
          'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first()),
          'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->first()),
          'vendor_perms' => $vendorPerms
        ]);
      }
      else return redirect()->back();
    }

    function addCoupon(Request $request){
      if(Auth::user()->permission == 2){
        if(Coupon::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id)->count() >= 10){
          return redirect(url('/') . '/vendor/request-stall');
        }else{
          // dd($request->all());
          $coupon = new Coupon();
          $coupon->tax = 21.00;
          $coupon->item = $request->input('item');
          $coupon->name = $request->input('name');
          $coupon->description = $request->input('desc');
          $coupon->price = number_format($request->input('price'), 2, '.', '');
          $coupon->vendorID = Vendor::where('ownerID', Auth::user()->id)->first()->id;
          if($request->file('image')){
            $file = $request->file('image');
            $filename= Str::random(25).".".$file->extension();
            $file-> move(public_path('uploads/event-s/thumbnails'), $filename);
            $coupon->image_url= $filename;
          }
          $coupon->save();
          return redirect(url('/') . '/vendor/request-stall')->with('success', 'Coupon succesvol toegevoegd.');
        }
      }
      else return redirect()->back();
    }

    function editCoupon(Request $request, $id){
      if(Auth::user()->permission == 2){
        $coupon = Coupon::find($id);
        if($coupon->vendorID == Vendor::where('ownerID', Auth::user()->id)->first()->id)

        $coupon->name = $request->input('name');
        $coupon->description = $request->input('desc');
        $coupon->price = number_format($request->input('price'), 2);
        if($request->file('image')){
          $file = $request->file('image');
          $filename= Str::random(25).".".$file->extension();
          $file-> move(public_path('uploads/event-s/thumbnails'), $filename);
          $coupon->image_url= $filename;
        }
        $coupon->save();

        return redirect(url('/') . '/vendor/request-stall')->with('success', 'Coupon succesvol bijgewerkt.');
      }
      else return redirect()->back();
    }

    function deleteCoupon($id){
      if (Auth::user()->permission == 2){
        if(Coupon::find($id)->vendorID == Vendor::where('ownerID', Auth::user()->id)->first()->id){
          $coupon = Coupon::find($id);
          $coupon->delete();
        }

        return redirect(url('/') . '/vendor/request-stall')->with('success', 'Coupon succesvol verwijderd.');
      }
    }

    function product($id){
      $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){

        $product = Product::find($id);

        return view('vendor.stall.product', [
          'product' => $product,
          'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          'vendor_perms' => $vendorPerms
        ]);
      }
      else return redirect()->back();
    }

    function editProduct(Request $request, $id){
      if(Auth::user()->permission == 2){
        if($request->remove_image){
            if($request->remove_image == 'main-image'){
                $first_image = ProductImage::where('product_id', $id)->first();
                $product = Product::find($id);
                if($first_image && $product){
                    $product->update([
                        'image_url' => $first_image->image
                    ]);
                    $first_image->delete();
                }
            }else{
                $image = ProductImage::find($request->remove_image);
                if($image){
                    $image->delete();
                }
            }

            return back()->with('success', 'Productafbeelding succesvol verwijderd.');
        }else{
            $product = Product::find($id);
            if($product->vendorID == Vendor::where('ownerID', Auth::user()->id)->first()->id)

            //product image uploads
            if($request->file('thumbnail')){
                foreach($request->file('thumbnail') as $key => $file){
                    $filename= Str::random(25).$key.".".$file->extension();
                    $file-> move(public_path('uploads/products'), $filename);
                    // $product->image_url = $filename;
                    ProductImage::create([
                        'product_id'=> $id,
                        'image' => $filename
                    ]);
                }
                // $file= $request->file('thumbnail');
            }

            $product->name = $request->input('name');
            $product->description = $request->input('desc');
            // $product->size = $request->input('size');
            $product->price = number_format($request->input('price'), 2);
            $product->save();
        }

        return redirect(url('/') . '/vendor/request-stall')->with('success', 'Product succesvol bijgewerkt.');
      }
      else return redirect()->back();
    }

    function addProduct(Request $request){

        $request->validate([
            'image_url' => 'required'
        ],[
            'image_url.required' => 'Productafbeelding is vereist'
        ]);

      if(Auth::user()->permission == 2){
        $product = new Product();

        // dd($product->id);

        $product->tax = $request->input('tax');
        $product->name = $request->input('name');
        $product->description = $request->input('desc');
        $product->price = number_format($request->input('price'), 2, '.', '');
        $product->vendorID = Vendor::where('ownerID', Auth::user()->id)->first()->id;
        $product->stock = $request->input('stock');

        //product image uploads
        if($request->file('image_url')){
            foreach($request->file('image_url') as $key => $file){
                // $file= $request->file('image_url');
                $filename= Str::random(25).$key.".".$file->extension();
                $file-> move(public_path('uploads/products'), $filename);
                if($key == 0){
                    $product->image_url= $filename;
                    $product->save();
                }else{
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'  => $filename
                    ]);
                }
            }
        }
        if($request->input('size_status')){
            $product->size = 'yes';
            if($request->input('size_name')){
                foreach ($request->input('size_name') as $key => $value){
                    ProductSize::create([
                        'product_id' => $product->id,
                        'name' => $value,
                        'stock' => $request->input('size_stock')[$key] ?? null,
                    ]);
                }
            }
        }




        return redirect(url('/') . '/vendor/request-stall')->with('success', 'Product succesvol toegevoegd.');
      }
      else return redirect()->back();
    }

    function deleteProduct($id){
      if (Auth::user()->permission == 2){
        if(Product::find($id)->vendorID == Vendor::where('ownerID', Auth::user()->id)->first()->id){
          $product = Product::find($id);
          $product->delete();
        }

        return redirect(url('/') . '/vendor/request-stall')->with('success', 'Product succesvol verwijderd.');
      }
    }

    function auction(Request $request){
        $vendor = Vendor::where('ownerID', Auth::user()->id)->first();
        $remaining_items = $vendor->auction_item_count - $vendor->getAllAuction->count();
        $vendorPerms = $vendor->permissions ?? '';

        if(Auth::user()->permission == 2 && str_contains($vendorPerms, 'auction') && $remaining_items > 0){
            $events = Event::all();

            // if($vendor->auction_item_count == null){
            //     return view('vendor.auction.auction_item_count', [
            //         'events' => $events,
            //         'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
            //         'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
            //         'vendor_perms' => $vendorPerms
            //     ]);
            // }


            // if(!empty($request->input('send'))){
            //   if($request->input('send') == "success") return view('vendor.auction.index', [
            //       'events' => $events,
            //       'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
            //       'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
            //       'vendor_perms' => $vendorPerms
            //   ]);
            // }
            return view('vendor.auction.index', [
            'events' => $events,
            'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
            'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
            'vendor_perms' => $vendorPerms,
            'remaining_items' => $remaining_items,
            ]);
        }
        else return redirect()->back();
    }

    function addAuction(Request $request){
      if (Auth::user()->permission == 2){
          $auction = new Auction();
          $auction->name = $request->input('name');
          $auction->description = $request->input('desc');
          // $auction->item = $request->input('item');
          $auction->min_bid = $request->input('min_bid');
          $auction->current_bid = $request->input('min_bid');
          $auction->min_step = 1;
          $auction->start_time = "00:00";
          $auction->end_time = "00:00";
          $auction->tax = 21.00;
          $auction->stock = 0;

          //product image uploads
          if($request->file('product_image')){
              $file= $request->file('product_image');
              $filename= Str::random(25).".".$file->extension();
              $file-> move(public_path('uploads/auctions/prodimgs'), $filename);
              $auction->image_url= $filename;
          }

          $vendor = Vendor::where('ownerID', Auth::user()->id)->first();

          $auction->eventID = $vendor->eventID;
          $auction->vendorID = $vendor->id;
          $auction->status = "awaiting_approval";
          $auction->save();
        //   $vendor->auction_item_count -= 1;
        //   $vendor->save();
        //   if($vendor->auction_item_count == $vendor->getAllAuction->count()){
        //       Mail::to(Auth::user()->email)->send(new AuctionNotificationMail());
        //   }
        return redirect('/vendor')->with('success', 'Veiling is succesvol toegevoegd.');
        //   return redirect('/vendor/request-auction-product');
      }
    }

    function auction_item_count(Request $request){
        return back();
        Vendor::where('ownerID', Auth::user()->id)->update([
            'auction_item_count' => $request->auction_item_count,
        ]);
        return redirect()->route('request.auction.product');
    }

    function event(){
      if(Auth::user()->permission == 2){
        //resume code
      }
      else return redirect()->back();
    }

    function stallNoSampleChange(Request $request){
      if(Auth::user()->permission == 2){
        $stall = Stall::find($request->stall_id);
        if($stall){
            $stall->update([
                'no_sample' => !$stall->no_sample,
            ]);
        }
      }
      return redirect()->back();
    }

    function index(){
      // $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){
        $vendor = Vendor::where('ownerID', Auth::user()->id)->first();
        return view('vendor.index', [
          'vendor' => $vendor,
          // 'vendor' => Vendor::where('ownerID', Auth::user()->id)->first()->name ?? '',
          // 'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          // 'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          // 'vendor_perms' => $vendor->permissions,
        ]);
      }
      else return redirect()->back();
    }

    function accountSettings(){
      // $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){
        $vendor = Vendor::where('ownerID', Auth::user()->id)->first();
        return view('vendor.account-settings', [
          'vendor' => $vendor,
          // 'vendor' => Vendor::where('ownerID', Auth::user()->id)->first()->name ?? '',
          // 'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          // 'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          // 'vendor_perms' => $vendorPerms
        ]);
      }
      else return redirect()->back();
    }

    // function saldo(){
    //     $vendor = Vendor::where('ownerID', Auth::user()->id)->first();
    //     if(Auth::user()->permission == 2){
    //         $total_sell = 0;
    //         $products = Product::where('vendorID', $vendor->id)->get();
    //         foreach($products as $product){
    //           $total_sell += $product->price;
    //         }
    //         $coupons = Coupon::where('vendorID', Auth::user()->id)->get();
    //         foreach($coupons as $coupon){
    //           $total_sell += $coupon->price;
    //         }
    //         return view('vendor.saldo', [
    //           'vendor' => $vendor,
    //         'total_sell' => $total_sell
    //         ]);
    //     }
    //     else return redirect()->back();
    // }

    public function saldo() {
      $vendor = Vendor::where('ownerID', Auth::user()->id)->first();

      if (Auth::user()->permission == 2 && $vendor) {
          $completedOrders = Order::where('paid_to', $vendor->id)
                                ->where('paid', 'paid')
                                ->get();
          $soldItems = [
              'products' => [],
              'coupons' => [],
              'auctions' => []
          ];

          $total_sell = 0;
          $total_product_sell = 0;
          $total_coupon_sell = 0;
          $total_auction_sell = 0;
          foreach ($completedOrders as $order) {
              // $item = null;
              // $type = null;

              // Check if order is for a product
              $product = Product::find($order->product_code);
              if ($product && $product->vendorID == $vendor->id) {
                // $item = $product;
                // $type = 'products';
                $total_product_sell += $order->price;
                $total_sell += $order->price;
              }

              // Check if order is for a coupon
              $coupon = Coupon::find($order->product_code);
              if ($coupon && $coupon->vendorID == $vendor->id) {
                  $total_coupon_sell += $order->price;
                  $total_sell += $order->price;
              }

              // Check if order is for an auction
              $auction = Auction::find($order->product_code);
              if ($auction && $auction->vendorID == $vendor->id) {
                  $total_auction_sell += $order->price;
                  $total_sell += $order->price;
              }

              // if ($item) {
              //     $soldItems[$type][] = [
              //         'name' => $item->name,
              //         'order_number' => $order->id,
              //         'sold_to' => $order->first_name . ' ' . $order->last_name,
              //         'price' => $order->price
              //     ];
              //     $total_sell += $order->price;
              // }
          }

          return view('vendor.saldo', [
              'vendor' => $vendor,
              'total_sell' => $total_sell,
              'total_product_sell' => $total_product_sell,
              'total_coupon_sell' => $total_coupon_sell,
              'total_auction_sell' => $total_auction_sell,
          ]);
      }
      return redirect()->back();
    }

    function verkoopoverzicht(){
      // $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){
        $vendor = Vendor::where('ownerID', Auth::user()->id)->first();
        return view('vendor.verkoopoverzicht', [
          'vendor' => $vendor,
          // 'vendor' => Vendor::where('ownerID', Auth::user()->id)->first()->name ?? '',
          // 'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          // 'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          // 'vendor_perms' => $vendorPerms,
          'stall' => Stall::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->count(),
          'product' => Product::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->count(),
          'coupon' => Coupon::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->count(),
          'auction' => Auction::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->count(),
        ]);
      }
      else return redirect()->back();
    }
    function retourenEnAnnuleringen(){
      // $vendorPerms = Vendor::where('ownerID', Auth::user()->id)->first()->permissions ?? '';
      if(Auth::user()->permission == 2){
        $vendor = Vendor::where('ownerID', Auth::user()->id)->first();
        return view('vendor.retourenEnAnnuleringen', [
          'vendor' => $vendor,
          // 'vendor' => Vendor::where('ownerID', Auth::user()->id)->first()->name ?? '',
          // 'logoAd' => empty(Logoad::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          // 'movie' => empty(Movie::where('vendorID', Vendor::where('ownerID', Auth::user()->id)->first()->id ?? null)->first()),
          // 'vendor_perms' => $vendorPerms
        ]);
      }
      else return redirect()->back();
    }

    public function VendorAuctionItemUpdate(Request $request){
        if(Auth::user()->permission != 3){
            return redirect('/');
        }
        $vendor = Vendor::find($request->vendor_id);
        if($vendor){
            $vendor->update([
                'auction_item_count' => $request->auction_item_count
            ]);
        }
        return back()->with('success', 'Veilingitemlimiet succesvol bijgewerkt');
    }

}
