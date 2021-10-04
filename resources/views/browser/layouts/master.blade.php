@extends('browser.layouts.partials.main')

@section('master')

  @include('browser.layouts.partials.navbar')

  @yield('content')

  @include('browser.layouts.partials.footer')
  
@endsection