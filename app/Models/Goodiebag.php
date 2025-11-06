<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goodiebag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function stall()
    {
        return $this->belongsTo(Stall::class, 'stallID');
    }
    public function getVendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function vendor()
    {
        return $this->hasOneThrough(
            Vendor::class,
            Stall::class,
            'id',          // Foreign key on stalls table
            'id',          // Foreign key on vendors table
            'stallID',     // Local key on goodiebags table
            'vendorID'     // Local key on stalls table
        );
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'eventID');
    }
}
