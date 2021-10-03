<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductReview extends Model
{
    use HasFactory;

    public static function boot() {
        parent::boot();

        static::created(function($productReview) {

            DB::transaction(function () use($productReview) {
                logger($productReview);

                $product = Product::where('id', $productReview->product_id)->first();

                $product->update([
                    'rating' => $product->product_reviews->avg('rating')
                ]);

                Activity::create([
                    'user_id' => $productReview->user_id,
                    'activity' => 'product.reviewed'
                ]);
            });
        });
    }

    protected $fillable = [
        'rating',
        'review',
        'product_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function product() {
        return $this->belongsTo('App\Models\ProductReview');
    }
}
