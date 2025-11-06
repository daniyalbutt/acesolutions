<x-app-layout>
    <div class="page-header">
		<div class="page-block card mb-0">
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title border-bottom pb-2 mb-2">
							<h4 class="mb-0">Projects - {{ $project->name }}</h4>
							@can('project')
                            <div class="admin-status">
                                <a href="{{ route('projects.index') }}" class="btn btn-primary">Project List</a>
                                <form action="{{ route('projects.updateStatus', $project->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <select name="status" id="status" class="form-control">
                                            <option value="0" {{ $project->status == 0 ? 'selectes' : '' }}>Pending</option>
                                            <option value="1" {{ $project->status == 1 ? 'selectes' : '' }}>In Progress</option>
                                            <option value="2" {{ $project->status == 2 ? 'selectes' : '' }}>Approved</option>
                                        </select>
                                        <button class="btn btn-info" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
							@endcan
						</div>
					</div>
					<div class="col-md-12">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ph ph-house"></i></a></li>
							<li class="breadcrumb-item"><a href="javascript: void(0)">Projects</a></li>
							<li class="breadcrumb-item" aria-current="page">{{ $project->name }}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-lg-5 col-xxl-4">
            <div class="card overflow-hidden">
                <div class="card-body position-relative">
                    <div class="text-center mt-3">
                        <div class="chat-avtar d-inline-flex mx-auto">
                            <img class="rounded-circle img-fluid wid-90 img-thumbnail" src="{{ $project->user->profile_image ? asset('storage/' . $project->user->profile_image) : asset('img/avatar-2.jpg') }}" alt="{{ $project->user->name }}"> <i class="chat-badge bg-success me-2 mb-2"></i>
                        </div>
                        <h5 class="mb-0">{{ $project->user->name }}</h5>
                        <p class="text-muted text-sm"><a href="#" class="link-primary">{{ $project->user->email }}</a></p>
                        <div class="row g-3">
                            <div class="col-6 border border-top-0 border-bottom-0 border-left-0">
                                <h5 class="mb-0">{{ count($project->user->projects) }}</h5>
                                <small class="text-muted">Total Project</small>
                            </div>
                            <div class="col-6">
                                @php
                                    $uploadedFileCount = $project->files->count();
                                    $totalFiles = $uploadedFileCount + (!empty($project->file) ? 1 : 0);
                                @endphp
                                <h5 class="mb-0">{{ $totalFiles }}</h5>
                                <small class="text-muted">Current Project Files</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Project information</h5>
                </div>
                <div class="card-body position-relative">
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                        <p class="mb-0 text-muted me-1">Company Name</p>
                        <p class="mb-0">{{ $project->company_name }}</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                        <p class="mb-0 text-muted me-1">Company Address</p>
                        <p class="mb-0">{{ $project->company_address }}</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                        <p class="mb-0 text-muted me-1">Company Phone</p>
                        <p class="mb-0">{{ $project->company_phone }}</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                        <p class="mb-0 text-muted me-1">Company Email</p>
                        <p class="mb-0">{{ $project->company_email }}</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                        <p class="mb-0 text-muted me-1">Name</p>
                        <p class="mb-0">{{ $project->name }}</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                        <p class="mb-0 text-muted me-1">Description</p>
                        <p class="mb-0">{{ $project->description }}</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100">
                        <p class="mb-0 text-muted me-1">Additional Notes</p>
                        <p class="mb-0">{{ $project->additional_notes }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xxl-8">
            @if($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            @if(!empty($project->file))
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>
                        <a href="{{ asset('storage/' . $project->file) }}" target="_blank">
                            {{ basename($project->file) }}
                        </a>
                        <span class="badge bg-info ms-2">User Main File</span>
                    </h5>
                </div>
                <div class="card-body">
                    @can('edit project')
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Replace / Add Admin File</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="ph ph-upload-simple me-1"></i> Upload File
                            </button>
                        </div>
                    </form>
                    @endcan
                </div>
            </div>
            @endif
            @foreach($project->files as $file)
            @php
                $uploader = $file->uploader;
                $isAdmin = $uploader && $uploader->hasRole('admin');
            @endphp

            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>
                        <a href="{{ asset('storage/' . $file->file) }}" target="_blank">
                            {{ basename($file->file) }}
                        </a>
                    </h5>
                </div>

                <div class="card-body">
                    @if(!empty($file->admin_file))
                    <div class="border rounded p-3 mb-3 bg-light">
                        <strong>Admin Replacement File:</strong><br>
                        <a href="{{ asset('storage/' . $file->admin_file) }}" target="_blank">
                            {{ basename($file->admin_file) }}
                        </a>
                    </div>
                    @endif
                    @can('edit project')
                    <form action="{{ route('admin.project-files', $file->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Replace / Add Admin File</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="ph ph-upload-simple me-1"></i> Upload File
                            </button>
                        </div>
                    </form>
                    @endcan
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @push('scripts')

    @endpush
</x-app-layout>