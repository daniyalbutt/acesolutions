<x-guest-layout>
    <div class="auth-main v1 bg-grd-primary">
        <div class="auth-wrapper">
            <div class="auth-form">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="card my-5">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="guest-image-box">
                                    <img src="{{ asset('img/logo-black.png') }}" alt="images" class="img-fluid">
                                </div>
                                <h4 class="f-w-500 mb-1">Forgot Password</h4>
                                @if (session('status'))
                                <div class="alert alert-info mt-3">
                                    <p class="mb-0">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
                                </div>
                                @endif
                                <p class="mb-4">Back to <a href="{{ route('login') }}" class="link-primary ms-1">Log in</a></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid mt-3"><button type="submit" class="btn btn-primary">Send reset email</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
