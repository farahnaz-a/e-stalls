<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logoad extends Model
{
    use HasFactory;

    public function getVendor(){
        return $this->belongsTo(Vendor::class, 'vendorID', 'id');
    }
}
