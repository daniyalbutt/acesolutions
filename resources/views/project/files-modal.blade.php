<div class="row">
    <div class="col-md-12">
        <h6>Admin Files</h6>
        <ul class="list-group mb-3">
            @forelse($adminFiles as $file)
                @php
                    $filePath = $file->file_path ?? $file->file;
                    $fileName = basename($filePath);
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ asset('storage/' . $filePath) }}" target="_blank">
                        {{ $fileName }}
                    </a>
                    <span class="badge bg-primary">Admin</span>
                </li>
            @empty
                <li class="list-group-item text-muted">No admin files</li>
            @endforelse
        </ul>
        <h6>Your Files</h6>
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
                    <span class="badge bg-success">You</span>
                </li>
            @empty
                <li class="list-group-item text-muted">No user files</li>
            @endforelse
        </ul>
    </div>
</div>
