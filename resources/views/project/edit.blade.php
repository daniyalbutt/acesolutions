<x-app-layout>
	<div class="page-header">
		<div class="page-block card mb-0">
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="page-header-title">
							<h4 class="mb-0">Edit Project</h4>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ph ph-house"></i></a></li>
								<li class="breadcrumb-item"><a href="javascript:void(0)">Projects</a></li>
								<li class="breadcrumb-item" aria-current="page">Edit Project</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-end">
						@can('project')
						<a href="{{ route('projects.index') }}" class="btn btn-primary">Project List <span><i class="feather icon-arrow-right"></i></span></a>
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
					<h5>Edit Project Form</h5>
				</div>

				<div class="card-body">
					<form class="form" 
						method="POST" 
						action="{{ route('projects.update', $project->id) }}" 
						enctype="multipart/form-data">
						@csrf
						@method('PUT')

						@if($errors->any())
							{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
						@endif

						@if(session()->has('success'))
							<div class="alert alert-success">{{ session()->get('success') }}</div>
						@endif

						<div class="row">

							@php
								$company_name = $project->company_name ?? '';
								$company_address = $project->company_address ?? '';
								$name = $project->name ?? '';
								$company_phone = $project->company_phone ?? '';
								$company_email = $project->company_email ?? '';
								$description = $project->description ?? '';
								$additional_notes = $project->additional_notes ?? '';
							@endphp

							<div class="col-md-4 mb-3">
								<label class="form-label">Company Name *</label>
								<input type="text" name="company_name" class="form-control" value="{{ $company_name }}" readonly required>
							</div>

							<div class="col-md-4 mb-3">
								<label class="form-label">Company Address *</label>
								<input type="text" name="company_address" class="form-control" value="{{ $company_address }}" readonly required>
							</div>

							<div class="col-md-4 mb-3">
								<label class="form-label">Name *</label>
								<input type="text" name="name" class="form-control" value="{{ $name }}" readonly required>
							</div>

							<div class="col-md-4 mb-3">
								<label class="form-label">Company Phone *</label>
								<input type="text" name="company_phone" class="form-control"
									value="{{ $company_phone }}" required
									pattern="[0-9]+"
									oninput="this.value = this.value.replace(/[^0-9]/g, '')">
							</div>


							<div class="col-md-4 mb-3">
								<label class="form-label">Company Email *</label>
								<input type="email" name="company_email" class="form-control" value="{{ $company_email }}" readonly required>
							</div>

							<div class="col-md-4 mb-3">
								<label class="form-label">Description</label>
								<input type="text" name="description" class="form-control" value="{{ $description }}" readonly>
							</div>

							<div class="col-md-4 mb-3">
								<label class="form-label">Additional Notes</label>
								<input type="text" name="additional_notes" class="form-control" value="{{ $action == 1 ? $additional_notes : '' }}">
							</div>

							@if($action == 0)
							<div class="col-md-4 mb-3">
								<label class="form-label">Allowed PDFs, DOCs, CAD files *</label>
								<input type="file" name="file" class="form-control" required>
							</div>
							@endif

						</div>

						<button type="submit" class="btn btn-primary btn-submit">
							Update Project 
							<span><i class="feather icon-arrow-right"></i></span>
						</button>
					</form>
				</div>

			</div>
		</div>
	</div>
</x-app-layout>
