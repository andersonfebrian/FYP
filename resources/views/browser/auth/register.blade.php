@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Register Account</title>
@endsection

@section('content')
  @livewire('account-register-component')
@endsection