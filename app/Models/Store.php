<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Store extends Model
{
	use HasFactory;

	public static function boot()
	{
		parent::boot();
		static::created(function($store) {
			Activity::create([
				'activity' => 'store.created',
				'user_id' => Auth::id(),
			]);
		});
	}

	protected $fillable = [
		'name',
		'location',
		'country',
		'rating',
		'user_id'
	];

	public function owner()
	{
		return $this->hasOne('App\Models\User');
	}

	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}
}
