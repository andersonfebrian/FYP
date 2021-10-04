<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('currency')->nullable();
			$table->double('price')->nullable()->default(0.0);
			$table->longText('description')->nullable();
			$table->double('rating', 10, 2)->nullable()->default(0.0);
			$table->boolean('is_public')->nullable()->default(false);
			$table->unsignedBigInteger('store_id')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('products');
	}
}
