<div class="container mt-4">
    @if($state == 'init')
        <h2>Forget Password</h2>
        <div>
            <form wire:submit.prevent="accountExists">
                <label for="email" class="mb-2">Email</label>
                <input name="email" type="text" type="email" wire:model="email" placeholder="Email" class="form-control" required>
                @error('email')
                    <div class="alert alert-danger mt-2">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                @include('browser.layouts.partials.messages')
                <div class="d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-success form-control">Forget Password</button>
                </div>
            </form>
        </div>
    @elseif($state == 'biosecure_enabled')
        @livewire('biosecure-component', ['user' => $user, 'email' => $user['email'], 'from' => 'forget-password', 'frame_count' => 5])
    @elseif($state == 'reset_password')
        <h2>Reset Password</h2>
        <div>
            <form wire:submit.prevent="resetPassword">
                <div class="mt-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" wire:model="password" class="form-control mt-2">
                    @error('password')
                        <div class="alert alert-danger mt-2">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" wire:model="password_confirmation" class="form-control mt-2">
                    @error('password_confirmation')
                        <div class="alert alert-danger mt-2">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                <div class="mt-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success form-control">Reset Password</button>
                </div>
            </form>
        </div>
    @endif

</div>
