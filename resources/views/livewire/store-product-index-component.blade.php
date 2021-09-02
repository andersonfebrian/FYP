<div>
	<div class="container mt-2">

    @include('browser.layouts.partials.messages')

    <h1>Products - {{ Auth::user()->store->name }}</h1>

		<div class="row">
			<div class="col d-flex justify-content-end">
				<a href="{{ route('browser.products.create') }}" class="btn btn-success">Add Product</a>
			</div>
		</div>

		<table class="table mt-2">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
					<tr>
						<th>{{ $product->id }}</th>
						<td>{{ $product->name }}</td>
						<td>{{ $product->currency . ' ' . $product->price }}</td>
						<td>
							<a href="{{ route('browser.products.edit', $product) }}" class="btn btn-warning">Edit</a>
							<button onclick="" class="btn btn-danger">Delete</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
  </div>
</div>

@push('scripts')
	<script>

	</script>
@endpush
