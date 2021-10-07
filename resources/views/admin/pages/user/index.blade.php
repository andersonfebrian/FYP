@extends('admin.layouts.master')

@section('meta-title')
    <title>ALL USERS - ADMIN DASHBOARD</title>
@endsection

@section('content')
    @livewire('admin.user-component')
@endsection