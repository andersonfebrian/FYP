@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Start Selling Now!</title>
@endsection

@section('content')
  <div class="container mt-2">

    <div class="container">
      <h1 class="mt-2 ml-2 position-absolute">Start Selling Now!</h1>
      <img class="h-50 w-100"src="{{ asset('images/banner.png') }}" alt="">
      <div class="d-flex justify-content-end mt-2">
        <a href="" class="btn btn-success form-control">Start Selling</a>
      </div>
    </div>
    
  </div>
@endsection