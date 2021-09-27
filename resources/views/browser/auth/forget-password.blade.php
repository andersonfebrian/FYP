@extends('browser.layouts.master')

@section('meta-title')
    <title>{{ config('app.name') }} - Forget Password</title>
@endsection

@section('content')

    @livewire('forget-password-component')

@endsection