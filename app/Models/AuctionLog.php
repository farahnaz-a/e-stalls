<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionLog extends Model
{
    use HasFactory;
    protected $table = 'auction_logs';
    protected $guarded = ['id'];

}
