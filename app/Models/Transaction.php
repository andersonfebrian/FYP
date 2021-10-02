<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	use HasFactory;

	protected $fillable = [
		'transaction_id',
		'total_price',
		'user_id',
		'payment_status',
		'payment_intent_id'
	];

	public function purchases()
	{
		return $this->hasMany('App\Models\Purchase');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
