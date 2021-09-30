<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id', 'product_id'
    ];

    public function cart() {
        return $this->belongsTo('App\Models\Cart');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}
