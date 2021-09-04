<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserStoreProductTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::transaction(function () {
			$user = User::create([
				'first_name' => 'first name',
				'last_name' => 'last name',
				'email' => 'test@mail.com',
				'password' => Hash::make('12345'),
				'biosecure_enabled' => false
			]);

			$store = Store::create([
				'name' => 'test store',
				'country' => '',
				'location' => '',
				'rating' => 0.0,
				'user_id' => $user->id,
			]);

			Product::insert([
				[
					'name' => 'test product 1',
					'currency' => '',
					'quantity' => 0,
					'price' => 0,
					'description' => '',
					'rating' => 0.0,
					'brand' => '',
					'is_public' => 0,
					'store_id' => $store->id
				],
				[
					'name' => 'test product 2',
					'currency' => '',
					'quantity' => 0,
					'price' => 0,
					'description' => '',
					'rating' => 0.0,
					'brand' => '',
					'is_public' => 0,
					'store_id' => $store->id
				],
				[
					'name' => 'test product 3',
					'currency' => '',
					'quantity' => 0,
					'price' => 0,
					'description' => '',
					'rating' => 0.0,
					'brand' => '',
					'is_public' => 0,
					'store_id' => $store->id
				],
				[
					'name' => 'test product 4',
					'currency' => '',
					'quantity' => 0,
					'price' => 0,
					'description' => '',
					'rating' => 0.0,
					'brand' => '',
					'is_public' => 0,
					'store_id' => $store->id
				],
				[
					'name' => 'test product 5',
					'currency' => '',
					'quantity' => 0,
					'price' => 0,
					'description' => '',
					'rating' => 0.0,
					'brand' => '',
					'is_public' => 0,
					'store_id' => $store->id
				],
			]);
		});
	}
}
