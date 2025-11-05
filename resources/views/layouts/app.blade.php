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
                        <li class="dropdown pc-h-item">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="ph ph-sun-dim"></i></a>
                            <div class="dropdown-menu dropdown-menu-end pc-h-dropdown"><a href="#!" class="dropdown-item" onclick="layout_change('dark')"><i class="ph ph-moon"></i> <span>Dark</span> </a><a href="#!" class="dropdown-item" onclick="layout_change('light')"><i class="ph ph-sun-dim"></i> <span>Light</span> </a><a href="#!" class="dropdown-item" onclick="layout_change_default()"><i class="ph ph-cpu"></i> <span>Default</span></a></div>
                        </li>
                        <li class="dropdown pc-h-item">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="ph ph-bell"></i> <span class="badge bg-success pc-h-badge">3</span></a>
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
                                        <li class="list-group-item">
                                            <p class="text-span">Today</p>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0"><img src="{{ asset('img/avatar-2.jpg') }}" alt="user-image" class="user-avtar avtar avtar-s"></div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 me-3 position-relative">
                                                            <h5 class="mb-0 text-truncate">Keefe Bond <span class="text-body">added new tags to </span>💪 Design system</h5>
                                                        </div>
                                                        <div class="flex-shrink-0"><span class="text-sm text-muted">2 min ago</span></div>
                                                    </div>
                                                    <p class="position-relative text-muted mt-1 mb-2"><br><span class="text-truncate">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span></p>
                                                    <span class="badge bg-light-primary border border-primary me-1 mt-1">web design</span> <span class="badge bg-light-warning border border-warning me-1 mt-1">Dashobard</span> <span class="badge bg-light-success border border-success me-1 mt-1">Design System</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-s bg-light-primary"><i class="ph ph-chats-teardrop f-18"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 me-3 position-relative">
                                                            <h5 class="mb-0 text-truncate">Message</h5>
                                                        </div>
                                                        <div class="flex-shrink-0"><span class="text-sm text-muted">1 hour ago</span></div>
                                                    </div>
                                                    <p class="position-relative text-muted mt-1 mb-2"><br><span class="text-truncate">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="text-span">Yesterday</p>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-s bg-light-danger"><i class="ph ph-user f-18"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 me-3 position-relative">
                                                            <h5 class="mb-0 text-truncate">Challenge invitation</h5>
                                                        </div>
                                                        <div class="flex-shrink-0"><span class="text-sm text-muted">12 hour ago</span></div>
                                                    </div>
                                                    <p class="position-relative text-muted mt-1 mb-2"><br><span class="text-truncate"><strong>Jonny aber </strong>invites to join the challenge</span></p>
                                                    <button class="btn btn-sm rounded-pill btn-outline-secondary me-2">Decline</button> <button class="btn btn-sm rounded-pill btn-primary">Accept</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-s bg-light-info"><i class="ph ph-notebook f-18"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 me-3 position-relative">
                                                            <h5 class="mb-0 text-truncate">Forms</h5>
                                                        </div>
                                                        <div class="flex-shrink-0"><span class="text-sm text-muted">2 hour ago</span></div>
                                                    </div>
                                                    <p class="position-relative text-muted mt-1 mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0"><img src="{{ asset('img/avatar-2.jpg') }}" alt="user-image" class="user-avtar avtar avtar-s"></div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 me-3 position-relative">
                                                            <h5 class="mb-0 text-truncate">Keefe Bond <span class="text-body">added new tags to </span>💪 Design system</h5>
                                                        </div>
                                                        <div class="flex-shrink-0"><span class="text-sm text-muted">2 min ago</span></div>
                                                    </div>
                                                    <p class="position-relative text-muted mt-1 mb-2"><br><span class="text-truncate">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span></p>
                                                    <button class="btn btn-sm rounded-pill btn-outline-secondary me-2">Decline</button> <button class="btn btn-sm rounded-pill btn-primary">Accept</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-s bg-light-success"><i class="ph ph-shield-checkered f-18"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 me-3 position-relative">
                                                            <h5 class="mb-0 text-truncate">Security</h5>
                                                        </div>
                                                        <div class="flex-shrink-0"><span class="text-sm text-muted">5 hour ago</span></div>
                                                    </div>
                                                    <p class="position-relative text-muted mt-1 mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown-footer">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="d-grid"><button class="btn btn-primary">Archive all</button></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-grid"><button class="btn btn-outline-secondary">Mark all as read</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown pc-h-item header-user-profile">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                                <img src="{{ asset('img/avatar-2.jpg') }}" alt="user-image" class="user-avtar">
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
                                                    <div class="flex-shrink-0"><img src="{{ asset('img/avatar-2.jpg') }}" alt="user-image" class="wid-50 rounded-circle"></div>
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
