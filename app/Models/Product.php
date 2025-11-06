<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function productSize(){
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    
}
