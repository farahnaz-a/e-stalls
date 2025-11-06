<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    // protected $fillable = ['sell_count'];
    protected $guarded = ['id'];

    public function getVendors(){
        return $this->hasMany(Vendor::class, 'eventID', 'id');
    }
}
