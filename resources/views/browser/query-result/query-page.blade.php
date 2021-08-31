@extends('browser.layouts.master')

@section('meta-title')
  <title>Search Result for: {{ config('app.name') }}</title>
@endsection

@section('content')
  <div>
    {{ $products }}
  </div>
@endsection