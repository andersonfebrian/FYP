@extends('browser.layouts.master')

@section('meta-title')
    <title>{{ config('app.name') . ' - ' . user_store()->name }} - Edit</title>
@endsection

@section('content')
	<div class="container mt-2">

		<h1>Update Product</h1>
		
		<form action="{{ route('browser.products.update', ['product' => $product]) }}" method="POST">
			@csrf
			@method('PUT')

			<div>
				<label for="name">Product Name</label>
				<input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ $product->name }}">
			</div>

			<div class="row">
				<div class="col-2">
					<label for="currency">Currency</label>
					<datalist id="currencies">
						@foreach($currencies as $currency) 
							<option value="{{ $currency['id'] }}" >{{ $currency['id'] . ' - ' . $currency['value'] }}</option>
						@endforeach
					</datalist>
					<input type="text" list="currencies" name="currency" placeholder="Currency" class="form-control" value="{{ $product->currency }}">
				</div>

				<div class="col">
					<label for="price">Price</label>
					<input type="number" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price">
				</div>
			</div>

			<div class="mt-3">
        <label for="description">Product Description</label>
				<textarea name="description" id="editor" required>{{ $product->description }}</textarea>
			</div>

      <div class="mt-2 d-flex inline-block">
        <input type="checkbox" name="is_public" class="mt-auto mb-auto" id="is_public" {{ $product->is_public ? 'checked' : '' }} value="1">
        <label for="is_public" class="ml-2">Visible to Public</label>
      </div>

			@include('browser.layouts.partials.messages')
		
			<button type="submit" class="btn btn-success form-control mt-2"> Update Product </button>
		</form>

	</div>
@endsection