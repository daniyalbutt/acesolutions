<x-app-layout>
    <div class="page-header">
		<div class="page-block card mb-0">
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title border-bottom pb-2 mb-2">
							<h4 class="mb-0">Users</h4>
							@can('create user')
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
                            @endcan
						</div>
					</div>
					<div class="col-md-12">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ph ph-house"></i></a></li>
							<li class="breadcrumb-item"><a href="javascript: void(0)">User</a></li>
							<li class="breadcrumb-item" aria-current="page">User List</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="mb-3 mt-3">
		<form method="get" action="{{ route('users.index') }}">
			<div class="input-group justify-content-end" style="max-width: 400px; margin-left: auto;">
				<input type="text" 
					name="name" 
					class="form-control" 
					placeholder="Search user..." 
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
					<h5>User List</h5>
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
                                    <th>Client ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr>
                                    <td>
                                        <p class="list-item-heading">{{ $value->id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">{{ $value->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">{{ $value->email }}</p>
                                    </td>
                                    <td>
                                        <p class="text-muted"><span class="badge bg-info">{{ $value->getRole(); }}</span></p>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @can('edit user')
                                            <a href="{{ route('users.edit', $value->id) }}" class="btn btn-primary shadow btn-sm sharp me-1">
                                                <i class="feather icon-edit"></i>
                                            </a>
                                            @endcan
                                            @can('delete user')
                                            <form action="{{ route('users.destroy', $value->id) }}" method="post">
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
    @push('scripts')

    @endpush
</x-app-layout>