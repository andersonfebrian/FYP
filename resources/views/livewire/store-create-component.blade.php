<div>
	<div class="container mt-2">

		@if ($create)
			<h1>Set up your Store!</h1>
			<form wire:submit.prevent="createStore">
				@csrf
				<input type="text" wire:model="store_name" class="form-control" placeholder="Store Name">
				@error('store_name')
					<div class="alert alert-danger mt-2">
						{{ $message }}
					</div>
				@enderror
				<div class="d-flex inline-block mt-2">
					<input wire:model="checkbox" type="checkbox" class="mt-auto mb-auto" required> <p class="ml-2">By opening a store, you agree to the <a href="">Terms & Conditions</a></p>
				</div>
				@error('checkbox')
					<div class="alert alert-danger mt-2">
						{{ $message }}
					</div>
				@enderror
				<button type="submit" class="btn btn-success form-control mt-2">Open Store</button>
			</form>
		@else

			<div class="container">
				<h1 class="mt-2 ml-2 position-absolute">Start Selling Now!</h1>
				<img class="h-50 w-100" src="{{ asset('images/banner.png') }}" alt="">
				<div class="d-flex justify-content-end mt-2">
					<a wire:click="changeStatus" class="btn btn-success form-control">Start Selling</a>
				</div>
			</div>

		@endif
	</div>

</div>
