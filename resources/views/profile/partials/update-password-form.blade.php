<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ __('Saved.') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Current Password *</label>
                <input type="password" name="current_password" class="form-control" required autocomplete="current-password">
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Current Password *</label>
                <input type="password" name="password" class="form-control" required autocomplete="new-password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Confirm Password *</label>
                <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
</section>
