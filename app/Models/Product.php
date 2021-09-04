<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
	use HasFactory;

	public static function boot(){
		parent::boot();

		static::created(function($product) {
			Activity::create([
				'user_id' => Auth::id(),
				'activity' => 'product.created',
			]);
		});

		static::deleted(function(){
			Activity::create([
				'activity' => 'product.deleted',
				'user_id' => Auth::id(),
			]);
		});

		static::updated(function($product) {
			Activity::create([
				'activity' => 'product.updated',
				'user_id' => Auth::id(),
			]);
		});
	}

	protected $fillable = [
		'name',
		'currency',
		'quantity',
		'price',
		'description',
		'rating',
		'brand',
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
}
