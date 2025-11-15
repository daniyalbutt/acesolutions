<!-- https://codedthemes.com/demos/admin-templates/gradient-able/bootstrap/default/dashboard/index.html -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('css/phosphor.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" id="main-style-link">
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    </head>
    <body data-pc-header="header-1" data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <nav class="pc-sidebar">
            <div class="navbar-wrapper">
                <div class="m-header">
                    <a href="{{ route('dashboard') }}" class="b-brand text-primary">
                        <img src="{{ asset('img/logo-white.png') }}" alt="logo image" class="logo-lg">
                    </a>
                </div>
                <div class="navbar-content">
                    <ul class="pc-navbar">
                        <li class="pc-item pc-hasmenu {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class="pc-link">
                                <span class="pc-micon"><i class="ph ph-gauge"></i></span>
                                <span class="pc-mtext" data-i18n="Dashboard">Dashboard</span>
                            </a>
                        </li>
                        @can('project')
                        <li class="pc-item pc-hasmenu {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                            <a href="{{ route('projects.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ph ph-folder"></i></span>
                                <span class="pc-mtext" data-i18n="Projects">Projects</span>
                            </a>
                        </li>
                        @endcan
                        @canany(['role', 'user'])
                        <li class="pc-item pc-caption">
                            <label data-i18n="Admin Panel">Roles & Users</label> 
                            <i class="ph ph-books"></i>
                        </li>
                        @endcanany
                        @can('role')
                        <li class="pc-item pc-hasmenu {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                            <a href="{{ route('roles.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ph ph-shield-check"></i></span>
                                <span class="pc-mtext" data-i18n="Roles">Roles</span>
                            </a>
                        </li>
                        @endcan
                        @can('user')
                        <li class="pc-item pc-hasmenu {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ph ph-users-three"></i></span>
                                <span class="pc-mtext" data-i18n="Users">Users</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </nav>
        <header class="pc-header">
            <div class="header-wrapper">
                <!-- [Mobile Media Block] start -->
                <div class="me-auto pc-mob-drp">
                    <ul class="list-unstyled">
                        <!-- ======= Menu collapse Icon ===== -->
                        <li class="pc-h-item pc-sidebar-collapse"><a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i class="ph ph-list"></i></a></li>
                        <li class="pc-h-item pc-sidebar-popup"><a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i class="ph ph-list"></i></a></li>
                        <li class="dropdown pc-h-item">
                            <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="ph ph-magnifying-glass"></i></a>
                            <div class="dropdown-menu pc-h-dropdown drp-search">
                                <form class="px-3">
                                    <div class="mb-0 d-flex align-items-center"><input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ."> <button class="btn btn-light-secondary btn-search">Search</button></div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- [Mobile Media Block end] -->
                <div class="ms-auto">
                    <ul class="list-unstyled">
                        @php
                        $notifications = auth()->user()->unreadNotifications;
                        @endphp
                        <li class="dropdown pc-h-item">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="ph ph-bell"></i> <span class="badge bg-success pc-h-badge">{{ auth()->user()->unreadNotifications->count() }}</span></a>
                            <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <h4 class="m-0">Notifications</h4>
                                    <ul class="list-inline ms-auto mb-0">
                                        <li class="list-inline-item"><a href="#" class="avtar avtar-s btn-link-hover-primary"><i class="ti ti-arrows-diagonal f-18"></i></a></li>
                                        <li class="list-inline-item"><a href="#" class="avtar avtar-s btn-link-hover-danger"><i class="ti ti-x f-18"></i></a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 235px)">
                                    <ul class="list-group list-group-flush">
                                        @forelse ($notifications as $notification)
                                        <li class="list-group-item">
                                            <a href="{{ auth()->user()->hasRole('user') ? '#' : route('projects.show', ['project' => $notification->data['project_id'], 'notification_id' => $notification->id]) }}">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="avtar avtar-s bg-light-primary">
                                                            <i class="ph ph-folder f-18"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 me-3 position-relative">
                                                                <h5 class="mb-0 text-truncate">Projects</h5>
                                                            </div>
                                                            <div class="flex-shrink-0"><span class="text-sm text-muted">{{ $notification->created_at->diffForHumans() }}</span></div>
                                                        </div>
                                                        <p class="position-relative text-muted mt-1 mb-2"><span class="">{{ $notification->data['message'] }}</span></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        @empty
                                        <li class="list-group-item text-center text-muted">No new notifications</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="dropdown-footer">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary w-100">Mark all as read</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                        <li class="dropdown pc-h-item header-user-profile">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                                <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('img/avatar-2.jpg') }}" alt="{{ Auth::user()->name }}" class="user-avtar">
                            </a>
                            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <h4 class="m-0">Profile</h4>
                                </div>
                                <div class="dropdown-body">
                                    <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                        <ul class="list-group list-group-flush w-100">
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0"><img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('img/avatar-2.jpg') }}" alt="{{ Auth::user()->name }}" class="wid-50 rounded-circle"></div>
                                                    <div class="flex-grow-1 mx-3">
                                                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                                        <a class="link-primary" href="">{{ Auth::user()->email }}</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="{{ route('profile.password') }}" class="dropdown-item">
                                                    <span class="d-flex align-items-center"><i class="ph ph-key"></i> <span>Change password</span> </span>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                                    <span class="d-flex align-items-center"><i class="ph ph-user-circle"></i> <span>Edit profile</span> </span>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                                    @csrf
                                                    <a href="#" class="dropdown-item" onclick="document.getElementById('logout-form').submit(); return false;"><span class="d-flex align-items-center"><i class="ph ph-power"></i> <span>Logout</span></span></a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        @include('layouts.navigation')
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <section class="pc-container">
            <div class="pc-content">
                {{ $slot }}
            </div>
        </section>

        <footer class="pc-footer">
            <div class="footer-wrapper container-fluid">
                <div class="row">
                    <div class="col-sm-6 my-1">
                        <p class="m-0">Copyright All Right Reserved</p>
                    </div>
                    <div class="col-sm-6 ms-auto my-1">
                        
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/simplebar.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/theme.js') }}"></script>
        <script src="{{ asset('js/feather.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>
