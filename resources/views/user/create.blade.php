<x-app-layout>

	<div class="page-header">
		<div class="page-block card mb-0">
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="page-header-title">
							<h4 class="mb-0">Add User</h4>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ph ph-house"></i></a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0)">Users</a></li>
								<li class="breadcrumb-item" aria-current="page">Add User</li>
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
					<h5>Add User Form</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form" method="post" action="{{ route('users.store') }}">
								@csrf
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
											<div class="form-group mb-3">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" name="name" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group mb-3">
												<label class="form-label">E-mail</label>
												<input type="email" class="form-control" name="email" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group mb-3">
												<label class="form-label">Role</label>
												<select name="role" id="role" class="form-control" required>
													<option value="">Select Role</option>
													@foreach($roles as $key => $value)
													<option value="{{ $value->name }}">{{ $value->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Password</label>
												<input type="text" class="form-control" name="password" required>
											</div>
										</div>
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Save User <span><i class="feather icon-arrow-right"></i></span></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@push('scripts')
	@endpush
</x-app-layout>