<?php

namespace App\Http\Controllers\Browser\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
	public function store(Request $request)
	{
		logger($request->hasFile('file'));

		$path = storage_path('app/tmp');

		if (!file_exists($path)) {
			mkdir($path, 0777, true);
			$file = fopen($path . '/.gitignore', 'w');
			fwrite($file, '*' . PHP_EOL . '!.gitignore');
			fclose($file);
		}

		$file = $request->file('file');

		$file_name = uniqid() . '_' . trim($file->getClientOriginalName());

		$file->move($path, $file_name);

		return response()->json([
			'name' => $file_name,
			'original_name' => $file->getClientOriginalName()
		]);
	}

	public function remove(Request $request) {
		$path = storage_path('app/tmp');

		$result = unlink($path . '/' . $request->file);

		return response()->json([
				'message' => $result ? 'Success' : 'Error'
		], $result ? 200 : 500);
	}

	public function retrieve(Request $request, $product) {
		$product = Product::findOrFail($product);
		$product_images = $product->product_images->pluck('image_path')->toArray();


		$images = [];

		foreach($product_images as $filename) {
			$fn = substr($filename, strpos($filename, '_') + 1);

			$data = [
				'name' => $filename,
				'original_name' => $fn,
				'size' => filesize(storage_path("app/public/{$filename}")),
				'path' => "storage/$filename"
			];
			
			array_push($images, $data);
		}


		return response()->json([
			'images' => $images,
		]);
	}
}
