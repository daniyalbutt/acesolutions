<section>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @if (session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ __('Saved.') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Profile Image</label>
                <input type="file" name="profile_image" class="form-control">
                @if (Auth::user()->profile_image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                        alt="Profile Image"
                        class="rounded-full w-24 h-24 object-cover" style="width: 50px;height: 50px;object-fit: cover;">
                </div>
                @endif
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">First Name *</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required autofocus autocomplete="first_name">
                @error('first_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Last Name *</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required autocomplete="last_name">
                @error('last_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary" type="submit">Update Profile <span><i class="feather icon-arrow-right"></i></span></button>
        </div>
    </form>
</section>
