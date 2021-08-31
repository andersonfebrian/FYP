<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	use HasFactory;

	protected $fillable = [
		'transaction_id',
		'total_price'
	];

	public function purchases()
	{
		return $this->hasMany('App\Models\Purchase');
	}

	public function owner()
	{
		return $this->belongsTo('App\Models\User');
	}
}
