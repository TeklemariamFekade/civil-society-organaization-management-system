<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="img-circle elevation-2" alt="User Image">
       --}}
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @auth
                    <a href="{{ Route('admin.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
                @endauth
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="{{ Route('admin.dashboard') }}"
                        class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.allUser') }}"
                        class="nav-link {{ Request::is('admin/alluser') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>All Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('admin.viewUser') }}"
                        class="nav-link {{ Request::is('admin/user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>Manage Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ Route('admin.profile') }}"
                        class="nav-link {{ Request::is('admin/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.changePassword') }}"
                        class="nav-link {{ Request::is('admin/changePassword') ? 'active' : '' }}">
                        {{-- class="nav-link {{ Request::is('dataencoder/changePassword') ? 'active' : '' }}" --}}
                        <i class="nav-icon fas fa-key"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>

            <style>
                .nav-item.active .nav-link {
                    background-color: blue;
                    color: white;
                }
            </style>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
