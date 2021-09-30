<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function cart_products() {
        return $this->hasMany('App\Models\CartProduct');
    }

    public function owner() {
        return $this->belongsTo('App\Models\User');
    }
}
