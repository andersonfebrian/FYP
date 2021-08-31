<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Purchase;
use App\Models\Product;

class ProductPurchaseTransactionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$product = Product::create([
			'name' => 'TestProduct'
		]);

		$product2 = Product::create([
			'name' => 'TestProduct2'
		]);

		$transaction = Transaction::create([
			'transaction_id' => 'TRX001'
		]);

		Purchase::create([
			'transaction_id' => $transaction->id,
			'product_id' => $product->id,
			'user_id' => 1
		]);

		Purchase::create([
			'transaction_id' => $transaction->id,
			'product_id' => $product2->id,
			'user_id' => 1
		]);
	}
}
