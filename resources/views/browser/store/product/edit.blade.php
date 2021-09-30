@extends('browser.layouts.master')

@section('meta-title')
    <title>{{ config('app.name') . ' - ' . user_store()->name }} - Edit</title>
@endsection

@section('content')
	<div class="container mt-2">

		<h1>Update Product</h1>
		
		<form action="{{ route('browser.products.update', ['product' => $product]) }}" method="POST" enctype="multipart/form-data">
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

			<div class="mt-2">
				<label for="">Product Image</label>
				<div class="dropzone" id="multiUpload"></div>
			</div>

			<div class="mt-3">
        <label for="description">Product Description</label>
				<textarea name="description" id="editor">{{ $product->description }}</textarea>
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

@push('scripts')
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			
			let mapData = {}
			let toDelete = []

			let dropzone = new Dropzone('div#multiUpload', {
				maxFileSize: 2,
				type: "POST",
				url: "{{ route('browser.api.store-image') }}",
				headers: {
					'X-CSRF-TOKEN' : "{{ csrf_token() }}"
				},
				addRemoveLinks: true,
				acceptedFiles: "image/*",
				success: function (file, response) {
					console.log(response);
					if (file.previewElement) {
						file.previewElement.classList.add("dz-success");
					}
					$('form').append('<input type="hidden" name="image[]" value="' + response.name + '">');
					mapData[file.name] = response.name;
				},
				removedfile: function (file) {
					file.previewElement.remove();
					// axios.post(route('browser.api.remove-image', {
					// 	'file': file.name,
					// 	'update' : 1
					// }));
					$('form').find('input[name="image[]"][value="' + file.name + '"]').remove();
				},
				error: function (file, message) {
					if (file.previewElement) {
						file.previewElement.classList.add("dz-error");
						if (typeof message !== "string" && message.error) {
							message = message.error;
						}
						for (let node of file.previewElement.querySelectorAll(
							"[data-dz-errormessage]"
						)) {
							node.textContent = "Image Upload Error";
						}
					}
				},
				init: function () {
					axios.get(route('browser.api.product-images', {
						product: "{{ $product->id }}"
					})).then(
						(res) => {
							console.log(res.data.images);
							res.data['images'].forEach((data) => {
								let mockFile = {
									name: data.name,
									size: data.size
								}

								dropzone.displayExistingFile(mockFile, "{{ asset("") }}" + data.path);	

								$('form').append('<input type="hidden" name="image[]" value="' + data.name + '">');

								mapData[data.original_name] = data.name;
							});
							console.log(mapData);
						},
						(err) => {}
					);
				}
			});
		});
	</script>
@endpush