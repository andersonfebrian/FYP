<div>
	<div class="container mt-2">
		<h1>Account Registration</h1>

		@if($state == 'init')
		<form method="POST" wire:submit.prevent="registerAccount">
			@csrf

			<input wire:model="user.first_name" type="text" name="first_name" class="form-control mt-2" placeholder="First Name" required value="{{ old('first_name') }}">

			<input wire:model="user.last_name" type="text" name="last_name" class="form-control mt-2" placeholder="Last Name" required value="{{ old('last_name') }}">

			<input wire:model="email" type="text" name="email" class="form-control mt-2" placeholder="Email" required value="{{ old('email') }}">

			<input wire:model="user.password" type="password"  class="form-control mt-2" placeholder="Password" required>

			<div class="mt-2 d-flex inline-block">
				<input type="checkbox" class="mt-auto mb-auto" id="enable_biosecure" wire:model="user.biosecure_enabled">
				<label for="enable_biosecure" class="ml-2">Enable Biosecure</label>
			</div>
			
			@include('browser.layouts.partials.messages')

			<div class="row mt-2">
				<div class="col">
					<div class="d-flex justify-content-end">
						<p class="mt-2 mb-2">Have an account? <a href="{{ route('browser.login.show') }}">Login Here</a></p>
					</div>
				</div>
				<div class="col-2">
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-success">Register Account</button>
					</div>
				</div>
			</div>

		</form>
		@elseif($state == 'biosecure_enabled')
			<div class="d-flex inline-block">
				<button wire:click="changeState('init')" type="button" class="btn btn-secondary">Back</button>
			</div>
			@livewire('biosecure-component', ['user' => $user, 'email' => $email])
		@endif
	</div>
</div>