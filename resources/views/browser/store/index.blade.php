@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Start Selling Now!</title>
@endsection

@section('content')  
  @livewire('store-create-component')
@endsection