<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Cart extends Model
{
    use HasFactory;
    public $contents = [];

    function currentCart($cart){
      $this->contents = $cart->contents;

    }

    function addToCart($productID, $amount){
      if(Product::find($productID)){
        $amount = (int)$amount;
        if(!empty($this->contents)){
          foreach($this->contents as $key => $content){

            if ($content['id'] == $productID){
               $amount = $amount + (int)$content['amount'];
               unset($this->contents[$key]);
             }
          }
        }
        array_push($this->contents, [
          'id' => $productID,
          'amount' => $amount
        ]);
      }

    }

    function remove($productID){
      foreach($this->contents as $key => $content){
        if($content['id'] == $productID){
          unset($this->contents[$key]);
        }
      }
    }

}
