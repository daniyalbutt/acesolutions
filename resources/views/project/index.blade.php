<x-app-layout>
    <div class="page-header">
		<div class="page-block card mb-0">
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title border-bottom pb-2 mb-2">
							<h4 class="mb-0">Projects</h4>
							@can('create project')
                            <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a>
                            @endcan
						</div>
					</div>
					<div class="col-md-12">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ph ph-house"></i></a></li>
							<li class="breadcrumb-item"><a href="javascript: void(0)">Projects</a></li>
							<li class="breadcrumb-item" aria-current="page">Project List</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="mb-3 mt-3">
		<form method="get" action="{{ route('projects.index') }}">
			<div class="input-group justify-content-end" style="max-width: 400px; margin-left: auto;">
				<input type="text" 
					name="name" 
					class="form-control" 
					placeholder="Search projects..." 
					value="{{ request('name') }}">
				<button class="btn btn-primary btn-sm ps-4 pe-4" type="submit">
					<i class="bi bi-search"></i> Search
				</button>
			</div>
		</form>
	</div>

    <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Project List</h5>
					@if($errors->any())
					{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
					@endif
					@if(session()->has('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
					@endif
				</div>
				<div class="card-body table-border-style">
					<div class="table-responsive">
						<table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    @if(Auth::user()->hasRole('admin'))
                                    <th>Uploaded By</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->company_email }}</td>
                                    <td>{{ $value->company_phone }}</td>
                                    <td><span class="badge {{ $value->status_class }}">{{ $value->status_label }}</span></td>
                                    <td>
                                        <a href="javascript:;" 
                                            data-id="{{ $value->id }}" 
                                            class="btn btn-success shadow btn-sm sharp viewFilesBtn">
                                            <i class="feather icon-eye"></i>
                                        </a>
                                    </td>
                                    @if(Auth::user()->hasRole('admin'))
                                    <td><span class="badge bg-info">{{ $value->user->name ?? '-' }}</span></td>
                                    @endif
                                    <td>
                                        <div class="d-flex">
                                            @if(Auth::user()->hasRole('admin') && Auth::user()->can('edit project'))
                                            <a href="{{ route('projects.show', $value->id) }}" class="btn btn-warning shadow btn-sm sharp me-1">
                                                <i class="feather icon-eye"></i>
                                            </a>
                                            @endif
                                            @can('edit project')
                                            <a href="{{ route('projects.edit', $value->id) }}" class="btn btn-primary shadow btn-sm sharp me-1">
                                                <i class="feather icon-edit"></i>
                                            </a>
                                            @endcan
                                            @can('delete project')
                                            <form action="{{ route('projects.destroy', $value->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow btn-sm sharp">
                                                    <i class="feather icon-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-box">
                            {{ $data->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
    <!-- Main page (outside AJAX) -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('projects.uploadFile') }}" enctype="multipart/form-data" id="uploadFileForm">
                <input type="hidden" name="project_id" id="project_id">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadFileModalLabel">Upload New File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Choose File <strong>*</strong></label>
                            <input type="file" name="file" class="form-control" required>
                            <small class="text-muted">Allowed: pdf, doc, docx, dwg, dxf</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="exampleModalLong" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="exampleModalLongTitle">Project Files</h5>
                    @if(!auth()->user()->hasRole('admin'))
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadFileModal">Add New File</button>
                    @endif
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).on("click", ".viewFilesBtn", function() {
            let projectId = $(this).data("id");
            $('#project_id').val(projectId);
            $("#exampleModalLong").modal("show");

            $("#exampleModalLong .modal-body").html("<p>Loading...</p>");

            $.ajax({
                url: "{{ url('projects/files') }}/" + projectId,
                method: "GET",
                success: function(res) {
                    $("#exampleModalLong .modal-body").html(res);
                },
                error: function() {
                    $("#exampleModalLong .modal-body").html("<p class='text-danger'>Failed to load files.</p>");
                }
            });
        });
    </script>
    @endpush
</x-app-layout>