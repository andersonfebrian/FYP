<div>
	<div class="container mt-2">

    @include('browser.layouts.partials.messages')

    <h1>Products - {{ Auth::user()->store->name }}</h1>

		<div class="row">
			<div class="col d-flex">
				<input type="text" wire:model="search" class="form-control" placeholder="Search Product...">
			</div>
			<div class="col d-flex justify-content-end">
				<a href="{{ route('browser.products.create') }}" class="btn btn-success">Add Product</a>
			</div>
		</div>

		<table class="table mt-2">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Product Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
					<tr>
						<th>{{ $product->id }}</th>
						<td>{{ $product->name }}</td>
						<td>{{ isset($product->description) ? strlen($product->description) > 50  ? substr_replace($product->description, " ...", 50) : $product->description  : '-' }}</td>
						<td>{{ $product->currency . ' ' . $product->price }}</td>
						<td>
							<a href="{{ route('browser.products.show', $product) }}" class="btn btn-secondary"><i class="far fa-eye"></i></a>
							<a href="{{ route('browser.products.edit', $product) }}" class="btn btn-warning"><i class="far fa-edit"></i></a>
							<button onclick="deleteProduct({{ $product }})" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="d-flex justify-content-center">
			@if(count($products) == 0)
				<p>No Products...</p>
			@else
				{{ $products->links() }}
			@endif
		</div>
  </div>
</div>

@push('scripts')
	<script>
		function deleteProduct(product) {
			Swal.fire({
				icon: 'warning',
				title: 'Delete Product?',
				text: 'This action cannot be reverted. If you do not want user to view the product, you can set it by editing the product.',
				allowOutsideClick: false,
				showCancelButton: true,
				confirmButtonText: 'Delete',
				reverseButtons: true,
				confirmButtonColor: 'red'
			}).then((value) => {
				console.log(value);
				if(value.isConfirmed) {
					window.Livewire.emit('deleteProduct', product);
				}
			});
		}
	</script>
@endpush
