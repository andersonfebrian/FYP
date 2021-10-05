@extends('browser.layouts.master')

@section('meta-title')
	<title>{{ config('app.name') }} - Edit Profile</title>
@endsection

@section('content')

	<div class="container mt-2">
		<h1>Edit Profile</h1>

		<form action="{{ route('browser.profile.update', ['user' => $user]) }}" method="POST">
			@csrf
			@method('PUT')

			<label for="first_name">First Name</label>
			<input type="text" class="form-control mt-2" placeholder="First Name" value="{{$user->first_name}}" name="first_name" required readonly>

			<label for="last_name">Last Name</label>
			<input type="text" class="form-control mt-2" placeholder="Last Name" value="{{$user->last_name}}" name="last_name" required readonly>

			<label for="email">Email</label>
			<input type="text" class="form-control mt-2" name="email" placeholder="Email" value="{{$user->email}}" disabled>

			<label for="">Password (Not required if not changing password)</label>
			<input type="password" class="form-control mt-2" placeholder="New Password" name="password">
			<input type="password" class="form-control mt-2" placeholder="Confirm Password" name="password_confirmation">
			
			@include('browser.layouts.partials.messages')
			
			<button type="submit" class="btn btn-success mt-2 form-control">Update Profile</button>
		</form>
	</div>

@endsection