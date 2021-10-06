<div class="shadow rounded-3 m-2">
	<div class="card rounded-3">
		<img class="card-img-top rounded-top-right-3 rounded-top-left-3 border" src="{{ count($product->product_images) == 0 ? asset('images/no-img.jpg') : asset("storage").'/'.$product->product_images->first()->image_path }}" alt="">
		<div class="card-body p-3">
			<p class="card-title">{{ $product->name }}</p>
			<p><i class="fa fa-star star-color"></i> {{  $product->rating }}</p>
			<p class="card-text">{{$product->currency . ' ' . $product->price }}</p>
			<div class="d-flex justify-content-end">
				<a href="{{ route('browser.product.show', $product) }}" class="btn btn-primary btn-sm">More Info...</a>
			</div>
		</div>
	</div>
</div>
