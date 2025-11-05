<x-app-layout>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card bg-grd-primary order-card">
                <div class="card-body">
                    <h6 class="text-white">Projects Request</h6>
                    <h2 class="text-end text-white mb-0"><i class="feather icon-folder float-start"></i><span>{{ $total_projects ?? 0 }}</span></h2>
                </div>
            </div>
        </div>
        @if(isset($total_users))
        <div class="col-md-6 col-xl-3">
            <div class="card bg-grd-success order-card">
                <div class="card-body">
                    <h6 class="text-white">Total Users</h6>
                    <h2 class="text-end text-white mb-0"><i class="feather icon-user float-start"></i><span>{{ $total_users }}</span></h2>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
