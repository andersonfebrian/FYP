@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Add Product</title>
@endsection

@section('content')
  <div class="container mt-2">

    <h1>Add Product</h1>

    <form action="{{ route('browser.products.store') }}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('POST')
      <div>
        <label for="name">Product Name</label>
        <input type="text" name="name" class="form-control" placeholder="Product Name" required value="{{ old('name') }}">
      </div>
      
      <div class="row mt-2 mb-2">
        <datalist id="currencies">
          @foreach($currencies as $currency) 
            <option value="{{ $currency['id'] }}" >{{ $currency['id'] . ' - ' . $currency['value'] }}</option>
          @endforeach
        </datalist>
        <div class="col-2">
          <label for="currency">Currency</label>
          <input type="text" list="currencies" name="currency" class="form-control" placeholder="Currency" required value="{{ old('currency') }}">
        </div>

        <div class="col">
          <label for="price">Price</label>
          <input type="number" name="price" placeholder="Price" class="form-control" required value="{{ old('price') }}">
        </div>
      </div>

      <div class="mt-2">
        <label for="">Product Image</label>
        <div class="dropzone" id="multiUpload"></div>
      </div>

      <div class="mt-2">
        <label for="description">Product Description</label>
        <textarea name="description" id="editor">{{ old('description') }}</textarea>
      </div>

      <div class="mt-2 d-flex inline-block">
        <input type="checkbox" name="is_public" class="mt-auto mb-auto" id="is_public" value="1" {{ old('is_public') ? 'checked' : '' }}>
        <label for="is_public" class="ml-2">Visible to Public</label>
      </div>
      
      @include('browser.layouts.partials.messages')

      <button type="submit" class="btn btn-success form-control mt-2">Add Product</button>
    </form>

  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {

        let mapData = {}

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
            console.log(mapData);
          },
          removedfile: function (file) {
            let file_name = mapData[file.name];
            file.previewElement.remove();
            axios.post(route('browser.api.remove-image'), {
              'file': file_name
            });
            $('form').find('input[name="image[]"][value="' + file_name + '"]').remove();
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
        });
    });
  </script>
@endpush