<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function booted()
    {
        static::creating(function ($order) {
            // Generate unique order_id if not set
            if (empty($order->order_id)) {
                do {
                    // Generate a random UUID
                    $order->order_id = Str::uuid()->toString();
                } while (self::where('order_id', $order->order_id)->exists());
            }
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'product_code');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'paid_to');
    }
    
}
