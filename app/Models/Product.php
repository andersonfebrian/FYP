<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'quantity',
		'price',
		'rating',
		'brand',
	];

	public function purchases()
	{
		return $this->hasMany('App\Models\Purchase');
	}

	public function stores()
	{
		return $this->belongsToMany('App\Models\Store');
	}
}
