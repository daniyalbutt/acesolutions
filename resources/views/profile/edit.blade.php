<x-app-layout>
    <div class="page-header">
        <div class="page-block card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title border-bottom pb-2 mb-2">
                            <h4 class="mb-0">Edit Profile</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ph ph-house"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Profile</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
    <div class="row">
        <div class="col-sm-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 me-3">
                            <h4 class="text-white">Email Verification</h4>
                            <p class="text-white text-opacity-75 mb-0">
                                Your email is not confirmed. Please check your inbox.
                                <form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link link-light p-0 m-0 align-baseline">
                                        <u>Resend confirmation</u>
                                    </button>
                                </form>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-white text-opacity-75">
                                    A new verification link has been sent to your email address.
                                </p>
                            @endif
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{ asset('img/img-accout-alert.png') }}" alt="img" class="img-fluid wid-80">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Edit Project Form</h5>
				</div>

				<div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
