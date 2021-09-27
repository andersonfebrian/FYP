@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Login</title>
@endsection

@section('content')

  @livewire('account-login-component')

@endsection