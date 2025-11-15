<x-app-layout>

	<div class="page-header">
		<div class="page-block card mb-0">
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="page-header-title border-bottom pb-2 mb-2">
							<h4 class="mb-0">Edit User - {{ $data->name }}</h4>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ph ph-house"></i></a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0)">Users</a></li>
								<li class="breadcrumb-item" aria-current="page">Edit User - {{ $data->name }}</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-end">
							@can('user')
							<a href="{{ route('users.index') }}" class="btn btn-primary">User List <span><i class="feather icon-arrow-right"></i></span></a>
							@endcan
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Edit Role Form - {{ $data->name }}</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
						<form class="form" method="post" action="{{ route('users.update', $data->id) }}">
							@csrf
							@method('PUT')
							<div class="box-body">
								@if($errors->any())
									{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
								@endif
								@if(session()->has('success'))
									<div class="alert alert-success">
										{{ session()->get('success') }}
									</div>
								@endif
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="form-label">Name</label>
											<input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="form-label">E-mail</label>
											<input type="email" class="form-control" name="email" value="{{ old('email', $data->email) }}" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="form-label">Role</label>
											<select name="role" id="role" class="form-control" required>
												@foreach($roles as $key => $value)
												<option value="{{ $value->name }}" {{ $data->getRole() == $value->name ? 'selected' : '' }}>{{ $value->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="form-label">Password</label>
											<input type="text" class="form-control" name="password">
										</div>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer mt-3">
								<button type="submit" class="btn btn-primary">Update User <span><i class="feather icon-arrow-right"></i></span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@push('scripts')
	@endpush
</x-app-layout>