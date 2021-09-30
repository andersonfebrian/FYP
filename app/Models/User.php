<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
	use HasFactory, Notifiable;

	public static function boot() {
		parent::boot();

		static::created(function($user) {
			Activity::create([
				'user_id' => $user->id,
				'activity' => 'account.created'
			]);
		});

		static::deleting(function($user){
			DB::transaction(function () use($user) {
				$user->store()->delete();
				$user->activities()->delete();
			});
		});
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'password',
		'biosecure_enabled'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function activities() {
		return $this->hasMany('App\Models\Activity');
	}

	public function store() {
		return $this->hasOne('App\Models\Store');
	}

	public function transactions()
	{
		return $this->hasMany('App\Models\Transaction');
	}

	public function purchases() {
		return $this->hasMany('App\Models\Purchase');
	}

	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	public function hasStore() {
		return isset($this->store);
	}

	public function cart() {
		return $this->hasOne('App\Models\Cart');
	}
}
