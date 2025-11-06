<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Event;
use App\Models\Product;
use App\Models\Stall;
use App\Models\Vendor;

class CartController extends Controller
{
    function atc(Request $request, $id){

      $request->validate(['amount' => "REQUIRED", 'productID' => "REQUIRED"]);
      $cart = new Cart;
      if($request->session()->get('cart')) $cart->currentCart($request->session()->get('cart'));
      $cart->addToCart($request->post('productID'), $request->post('amount'));
      $request->session()->put(['cart' => $cart]);
      return redirect('event/' . $id . '/winkelwagen');
    }

    function delete(Request $request, $id){
      $cart = new Cart;
      if($request->session()->get('cart')){
        $cart->currentCart($request->session()->get('cart'));
        $cart->remove($request->get('id'));
        $request->session()->put(['cart' => $cart]);
        return redirect(url('/') . '/event/' . $id . '/winkelwagen');
    }
      else return redirect(url('/') . '/event/' . $id . '/winkelwagen');
    }
    function cart(Request $request, $id){
      $products = [];
      $total = 0;
      $tax = 0;
      if($request->session()->get('cart')){
        foreach($request->session()->get('cart')->contents as $content){
          $product = Product::find($content['id']);
          $newProduct= [
            'id' => $content['id'],
            'name' => $product->name,
            'vendor' => Vendor::find($product->vendorID)->name,
            'price' => number_format($product->price * $content['amount'], 2),
            'amount' => $content['amount']
          ];
          array_push($products, $newProduct);
          $total += $product->price * $content['amount'];
          //   $tax += ($product->price-($product->price/(1+($product->tax/100)))) * $content['amount'];
          $tax += (($product->tax)/100) * $product->price * $content['amount'];
        }
    }

    $shipping_cost = null;
    if(isset($product)){
        // Every product's vendorID same. we just need a single vendorID. we peek it form 'foreach' loop.
        $stall = Stall::where('vendorID', $product->vendorID)->first();
        if($stall->free_shipping_above){
            if($stall->free_shipping_above < $total){
                $shipping_cost = number_format($stall->shipping_cost, 2);
                $total += $shipping_cost;
                $shipping_cost = "€".number_format($stall->shipping_cost, 2); // Adding €
            }else{
                $shipping_cost = "Free shipping!";
            }
        }else{
            $shipping_cost = number_format($stall->shipping_cost, 2);
            $total += $shipping_cost;
            $shipping_cost = "€".number_format($stall->shipping_cost, 2); // Adding €
        }
    }

    // Adding VAT/TAX
    $total += $tax;

    return view('event.cart.index', [
        'products' => $products,
        'total' => number_format($total, 2),
        'tax' => number_format($tax, 2),
        'shipping_cost' => $shipping_cost,
        'event' => Event::find($id),
        'user' => Auth::user()
        ]);
    }
}
