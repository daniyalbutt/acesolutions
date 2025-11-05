<x-app-layout>
	<div class="page-header">
		<div class="page-block card mb-0">
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title border-bottom pb-2 mb-2">
							<h4 class="mb-0">Edit Role - {{ $data->name }}</h4>
							@can('role')
							<a href="{{ route('roles.index') }}" class="btn btn-primary">Role List</a>
							@endcan
						</div>
					</div>
					<div class="col-md-12">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ph ph-house"></i></a></li>
							<li class="breadcrumb-item"><a href="javascript: void(0)">Roles</a></li>
							<li class="breadcrumb-item" aria-current="page">Edit Role - {{ $data->name }}</li>
						</ul>
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
							<form class="form" method="post" action="{{ route('roles.update', $data->id) }}">
								@if($errors->any())
									{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
								@endif
								@if(session()->has('success'))
									<div class="alert alert-success">
										{{ session()->get('success') }}
									</div>
								@endif
								@csrf
								@method('PUT')
								<div class="mb-3">
									<label class="form-label">Name</label>
									<input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}" required>
								</div>
								<div class="mb-3">
									<ul class="role-wrapper">
									@foreach($permission as $group => $perms)
										@php
											$allChecked = $perms->every(fn($p) => in_array($p->name, $rolePermissions));
										@endphp
										<li class="heading">
											<input type="checkbox" 
												class="group-checkbox" 
												id="group_checkbox_{{ $group }}" 
												{{ $allChecked ? 'checked' : '' }}>
											<label class="heading-label" for="group_checkbox_{{ $group }}"><strong>{{ ucfirst($group) }}</strong></label>

											<ul class="ml-3">
												@foreach($perms as $perm)
													<li>
														<input name="permission[]" value="{{ $perm->name }}" 
															type="checkbox" 
															class="child-checkbox child-{{ $group }}" 
															id="perm_checkbox_{{ $perm->id }}" 
															{{ in_array($perm->name, $rolePermissions) ? 'checked' : '' }} />
														<label for="perm_checkbox_{{ $perm->id }}">{{ ucfirst($perm->name) }}</label>
													</li>
												@endforeach
											</ul>
										</li>
									@endforeach
									</ul>
								</div>
								<button type="submit" class="btn btn-primary mb-4">Update</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


@push('scripts')
<script>
	$(document).on('change', '.group-checkbox', function() {
		let group = this.id.replace('group_checkbox_', '');
		$('.child-' + group).prop('checked', $(this).is(':checked'));
	});

	$(document).on('change', '.child-checkbox', function() {
		let group = $(this).attr('class').split(' ').find(c => c.startsWith('child-')).replace('child-', '');
		let allChecked = $('.child-' + group).length === $('.child-' + group + ':checked').length;
		$('#group_checkbox_' + group).prop('checked', allChecked);
	});
</script>
@endpush
</x-app-layout>