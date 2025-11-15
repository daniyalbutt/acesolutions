<x-guest-layout>
    <div class="auth-main v1 bg-grd-primary">
        <div class="auth-wrapper register-auth-wrapper">
            <div class="auth-form">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card my-5">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="guest-image-box">
                                    <img src="{{ asset('img/logo-black.png') }}" alt="images" class="img-fluid">
                                </div>
                                <h4 class="f-w-500 mb-1">Register with your email</h4>
                                <p class="mb-4">Already have an Account? <a href="{{ route('login') }}" class="link-primary">Log in</a></p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Company Name *" name="company_name" value="{{ old('company_name') }}" required>
                                        @error('company_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Company Address *" name="company_address" value="{{ old('company_address') }}" required>
                                        @error('company_address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Name *" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" name="company_phone" class="form-control"
                                            value="{{ old('company_phone') }}"
                                            placeholder="Company Phone *"
                                            required
                                            pattern="[0-9]+"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        @error('company_phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Company Email *" name="company_email" value="{{ old('company_email') }}" required>
                                @error('company_email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input name="email" type="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
                                        <span class="toggle-password"
                                            onclick="togglePassword('password_confirmation', this)" 
                                            style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                                            <i class="feather icon-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Description" name="description" value="{{ old('description') }}">
                            </div>

                            <div class="d-flex mt-1 justify-content-between">
                                <div class="form-check"><input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked=""> <label class="form-check-label text-muted" for="customCheckc1">I agree to all the Terms & Condition</label></div>
                            </div>
                            <div class="text-center mt-4"><button type="submit" class="btn btn-primary">Create an Account <span><i class="feather icon-arrow-right"></i></span></button></div>
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
