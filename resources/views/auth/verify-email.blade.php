<x-guest-layout>
    <div class="auth-main v1 bg-grd-primary">
        <div class="auth-wrapper">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="guest-image-box">
                                <img src="{{ asset('img/logo-black.png') }}" alt="images" class="img-fluid">
                            </div>
                            <h4 class="f-w-500 mb-1">Please confirm with Email</h4>
                            <p class="mb-0">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
                            @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-info mt-3">
                                <p class="mb-0">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="d-grid mt-4">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">{{ __('Resend Verification Email') }} <span><i class="feather icon-arrow-right"></i></span></button>
                            </form>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary w-100 mt-3">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
