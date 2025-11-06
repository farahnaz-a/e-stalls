<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAccessedReturnRequest extends Model
{
    use HasFactory;

    public function getReturnRequest()
    {
       return $this->hasMany(ReturnRequest::class, 'id', 'return_id' );
    }

}
