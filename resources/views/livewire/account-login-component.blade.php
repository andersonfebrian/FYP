<div>
	@if($state == 'init')
		<div class="container mt-2">
			<h1>Login</h1>
			<form method="POST" wire:submit.prevent="login">
				@csrf
				<input placeholder="Email" type="text" class="form-control mt2" name="email" required wire:model="email">

				<input placeholder="Password" type="password" class="form-control mt-2" name="password" required wire:model="password">
				
				@include('browser.layouts.partials.messages')

				<div class="row mt-2">
					<div class="col">
						<div class="d-flex justify-content-end">
							<p class="mb-2 mt-2"><a href="{{ route('browser.password.request') }}">Forgot Password?</a></p>
						</div>
					</div>
					<div class="col">
						<div class="d-flex justify-content-end">
							<p class="mb-2 mt-2">Don't have an account? <a href="{{ route('browser.register.show') }}">Register Here</a> </p>
						</div>
					</div>
					
					<div class="col">
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-success">Login</button>
						</div>
					</div>
				</div>

			</form>
		</div>
	@elseif($state == 'biosecure_enabled')
		@livewire('biosecure-component', ['user' => $user, 'email' => $user['email'], 'frame_count' => 24, 'from' => 'login', 'password' => $password])
	@endif
</div>
