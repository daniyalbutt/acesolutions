<x-guest-layout>
    <div class="auth-main v1 bg-grd-primary">
        <div class="auth-wrapper">
            <div class="auth-form">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="card my-5">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="guest-image-box">
                                    <img src="{{ asset('img/logo-black.png') }}" alt="images" class="img-fluid">
                                </div>
                                <h4 class="f-w-500 mb-1">Login with your email</h4>
                                <p class="mb-4">Don't have an Account? <a href="{{ route('register') }}" class="link-primary ms-1">Create Account</a></p>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 position-relative">
                                <input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
                                <span class="toggle-password"
                                    onclick="togglePassword('password', this)" 
                                    style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                                    <i class="feather icon-eye"></i>
                                </span>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-flex mt-1 justify-content-between align-items-center">
                                <div class="form-check"><input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked=""> <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label></div>
                                <a href="{{ route('password.request') }}">
                                    <h6 class="f-w-400 mb-0">Forgot Password?</h6>
                                </a>
                            </div>
                            <div class="d-grid mt-4"><button type="submit" class="btn btn-primary">Login</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    function togglePassword(fieldId, iconElement) {
        const input = document.getElementById(fieldId);
        if (input.type === "password") {
            input.type = "text";
            iconElement.innerHTML = '<i class="feather icon-eye-off"></i>';
        } else {
            input.type = "password";
            iconElement.innerHTML = '<i class="feather icon-eye"></i>';
        }
        feather.replace(); // Refresh feather icons
    }
    </script>
    @endpush
</x-guest-layout>
