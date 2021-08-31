<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	use HasFactory;

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