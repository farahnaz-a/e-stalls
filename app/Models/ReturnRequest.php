<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getOrder(){
        return $this->belongsTo(Order::class, 'order_number');
    }
    
    public function accessedUsers()
        {
          return $this->belongsToMany(User::class, 'vendor_accessed_return_requests', 'return_id', 'user_id');
        }
}
