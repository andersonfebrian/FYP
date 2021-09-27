<div class="border border-dark rounded-3 m-2">
	<div class="card rounded-3">
		<img class="card-img-top rounded-top-right-3 rounded-top-left-3" src="{{ asset('images\banner.png') }}" alt="">
		<div class="card-body p-3">
			<p class="card-title">{{ $product->name }}</p>
			<p><i class="fa fa-star star-color"></i> {{  $product->rating }}</p>
			<p class="card-text">RM {{ $product->price }}</p>
			<div class="d-flex justify-content-end">
				<a href="{{ route('browser.product.show', $product) }}" class="btn btn-primary btn-sm">More Info...</a>
			</div>
		</div>
	</div>
</div>
