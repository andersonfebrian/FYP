<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
	use HasFactory;

	public static function boot()
	{
		parent::boot();

		static::created(function ($product) {
			Activity::create([
				'user_id' => Auth::id(),
				'activity' => 'product.created',
			]);
		});

		static::deleting(function($product) {
			foreach($product->product_images as $data) {
				$data->delete();
			}
		});

		static::deleted(function () {
			Activity::create([
				'activity' => 'product.deleted',
				'user_id' => Auth::id(),
			]);
		});

		static::updated(function ($product) {
			Activity::create([
				'activity' => 'product.updated',
				'user_id' => Auth::id(),
			]);
		});
	}

	protected $fillable = [
		'name',
		'currency',
		'price',
		'description',
		'rating',
		'is_public',
		'store_id'
	];

	public function purchases()
	{
		return $this->hasMany('App\Models\Purchase');
	}

	public function store()
	{
		return $this->belongsTo('App\Models\Store');
	}

	public function product_images()
	{
		return $this->hasMany('App\Models\ProductImage');
	}

	public function cart_product() {
		return $this->belongsToMany('App\Models\CartProduct');
	}

	public function product_reviews() {
		return $this->hasMany('App\Models\ProductReview');
	}
}
