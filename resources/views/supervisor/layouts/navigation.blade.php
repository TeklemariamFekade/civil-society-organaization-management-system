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
                    <a href="{{ Route('supervisor.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
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
                    <a href="{{ route('supervisor.dashboard') }}"
                        class="nav-link {{ Request::is('supervisor/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('registration.index.viewRegistrationRequest') }}"
                        class="nav-link {{ Request::is('registration/index') ? 'active' : '' }}">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Registration Requests</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Service Requests <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ Route('service.address_change.viewAddressChangeRequest') }}"
                                class="nav-link {{ Request::is('service/address_change/addressChangeRequests') ? 'active' : '' }}">
                                <i class="fas fa-map-marker-alt nav-icon d-inline"></i> Address Change Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('service.name_change.viewNameChangeRequest') }}"
                                class="nav-link  {{ Request::is('service/name_change/nameChangeRequests') ? 'active' : '' }}">
                                <i class="fas fa-user-edit nav-icon d-inline"></i> Name Change Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('service.letter.viewLetterRequest') }}"
                                class="nav-link  {{ Request::is('service/letter/letterRequests') ? 'active' : '' }}">
                                <i class="fas fa-file-alt nav-icon d-inline"></i> Support Letter Requests
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notification.viewSupervisorNotification') }}"
                        class="nav-link {{ Request::is('notifications/supervisorNotification') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notification</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ Request::is('') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('supervisor.profile') }}"
                        class="nav-link {{ Request::is('supervisor/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supervisor.changePassword') }}"
                        class="nav-link
                        {{ Request::is('supervisor/changePassword') ? 'active' : '' }}">

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
