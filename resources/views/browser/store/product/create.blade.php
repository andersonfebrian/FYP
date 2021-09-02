@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Add Product</title>
@endsection

@section('content')
  <div class="container mt-2">

    <h1>Add Product</h1>

    <form action="{{ route('browser.products.store') }}" method="POST">
      @csrf
      @method('POST')

      <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
      
      <div class="row mt-2 mb-2">
        <datalist id="currencies">
          @foreach($currencies as $currency) 
            <option value="{{ $currency['id'] }}" >{{ $currency['id'] . ' - ' . $currency['value'] }}</option>
          @endforeach
        </datalist>
        <div class="col-2">
          <input type="text" list="currencies" name="currency" class="form-control" placeholder="Currency" required>
        </div>

        <div class="col">
          <input type="number" name="price" placeholder="Price" class="form-control" required>
        </div>
      </div>

      <button type="submit" class="btn btn-success form-control">Add Product</button>
    </form>

  </div>
@endsection