<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">

                @auth
                    <a href="{{ Route('expert.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
                @endauth
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{ route('expert.dashboard') }}"
                        class="nav-link {{ Request::is('expert/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('Task.expert.index') }}"
                        class="nav-link {{ Request::is('Task/expert/index') || Request::is('registration/approval/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>Task</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ Request::is('report') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('notification.viewExpertNotification') }}"
                        class="nav-link {{ Request::is('notifications/expertNotification') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notification</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ Route('expert.profile') }}"
                        class="nav-link {{ Request::is('expert/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My Profile</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('expert.changePassword') }}"
                        class="nav-link {{ Request::is('expert/changePassword') ? 'active' : '' }}">
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
