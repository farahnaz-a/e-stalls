<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasMany(Product::class, 'vendorID');
    }

    public function user(){
        return $this->belongsTo(User::class, 'ownerID');
    }

    public function stall(){
        return $this->hasOne(Stall::class, 'vendorID');
    }
    
    public function auction(){
        return $this->hasOne(Auction::class, 'vendorID');
    }
    public function getAllAuction(){
        return $this->hasMany(Auction::class, 'vendorID');
    }
    
    public function logo(){
        return $this->hasOne(Logoad::class, 'vendorID');
    }
    
    public function movie(){
        return $this->hasOne(Movie::class, 'vendorID');
    }
    
    public function goodiebag(){
        return $this->hasOne(Goodiebag::class, 'vendor_id');
    }

    public function pendingAuctionItem(){
        return $this->hasOne(Auction::class, 'vendorID')->where('status', 'awaiting_approval');
    }
}
