@php
    $isAdmin = auth()->user()->hasRole('admin');
@endphp
<div class="row">
    <div class="col-md-12">
        <h6>Admin Files</h6>
        <ul class="list-group mb-3">
            @forelse($adminFiles as $file)
                @if(!empty($file->admin_file))
                    @php
                        $filePath = $file->admin_file;
                        $fileName = basename($filePath);
                    @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ asset('storage/' . $filePath) }}" target="_blank">
                            {{ $fileName }}
                        </a>
                    </li>
                @endif
            @empty
                <li class="list-group-item text-muted">No admin files</li>
            @endforelse
        </ul>
        @if ($isAdmin)
        <h6>User Files</h6>
        @else
        <h6>Your Files</h6>
        @endif
        <ul class="list-group mb-3">
            @forelse($userFiles as $file)
                @php
                    $filePath = $file->file_path ?? $file->file;
                    $fileName = basename($filePath);
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ asset('storage/' . $filePath) }}" target="_blank">
                        {{ $fileName }}
                    </a>
                </li>
            @empty
                <li class="list-group-item text-muted">No user files</li>
            @endforelse
        </ul>
    </div>
</div>
