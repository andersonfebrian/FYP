@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') . ' - ' . Auth::user()->store->name }}</title>
@endsection

@section('content')
  @livewire('store-product-index-component')
@endsection