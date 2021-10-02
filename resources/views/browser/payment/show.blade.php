@extends('browser.layouts.master')

@section('meta-title')
    <title>{{ 'Complete Payment - ' . config('app.name') }}</title>
@endsection

@section('content')
    @livewire('payment-component', ['transaction' => $transaction])
@endsection