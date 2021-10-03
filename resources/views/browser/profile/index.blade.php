@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Profile</title>
@endsection

@section('content')

  <div class="container mt-2">
    <div class="col d-flex justify-content-center">
      <h1>Profile</h1>
    </div>
    <div class="col mt-4">
      <div class="col p-0">
        <div class="row">
          <div class="col-2">
            <div class="profile-image">
              <img src="{{ asset('images/placeholder.png') }}" alt="placeholder image" class="w-100 h-100">
            </div>
          </div>
          <div class="col">
            <h3>{{ auth_user()->full_name }}</h3>
            <h4>{{ auth_user()->email }}</h4>
            <a href="{{ route('browser.profile.edit') }}">Edit Profile</a>
            <div class="mt-2">
              <p>Member Since: {{ auth_user()->created_at->diffForHumans() }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col mt-4" style="height: 10rem">
      <div class="col p-0">
        <div class="row h-100">
          <div class="col p-0 rounded-3 shadow mr-2 ml-2" style="background-color: #e3e3e3;">
            <div class="col p-2 h-100">
              @if(isset(Auth::user()->store))
                <div class="h-100 d-flex justify-content-center align-items-center">
                  <p class="m-0 mr-2">{{ user_store()->name }}</p>
                  <a href="{{ route('browser.store-dashboard') }}" target="_blank">
                    <p class="d-inline mr-2">Store Dashboard</p>
                    <span class="fas fa-external-link-alt"></span>
                  </a>
                </div>
              @else
                <div class="h-100 d-flex justify-content-center align-items-center">
                  <a href="{{ route('browser.store-dashboard') }}" target="_blank">
                    <p class="d-inline mr-2">Start Selling Now!</p>
                    <span class="fas fa-external-link-alt"></span>
                  </a>
                </div>
              @endif
            </div>
          </div>
          <div class="col p-0 rounded-3 shadow mr-2 ml-2" style="background-color: #e3e3e3;">
            <div class="h-100 d-flex justify-content-center align-items-center">
              <a href="{{ route('browser.purchase-history') }}">
                <p class="d-inline mr-2">Purchase History</p>
              </a>
            </div>
          </div>
          <div class="col p-0 rounded-3 shadow mr-2 ml-2" style="background-color: #e3e3e3;">
            <div class="h-100 d-flex justify-content-center align-items-center">
              <a href="">
                <p class="d-inline mr-2">Activity Log</p>
                <span class="fas fa-external-link-alt"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection