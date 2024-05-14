<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?php
                $representative = Auth::guard('representative')->user();
                ?>
                <a href="{{ route('representative.profile') }}" class="d-block">{{ $representative->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="{{ Route('representative.dashboard') }}"
                        class="nav-link {{ Request::is('representative/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>CSO Registration</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ Route('registration.localrule') }}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Local CSO</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('registration.foreignrule') }}" class="nav-link ">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Foreign CSO</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('representative.csoList') }}"
                        class="nav-link {{ Request::is('representative/csoList') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>All CSO</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('service.index') }}"
                        class="nav-link {{ Request::is('service/index', 'service/nameChange', 'service/nameChangeForm', 'service/addressChange', 'service/addressChangeForm', 'service/logo_letter', 'service/logo_letter_form', 'service/meeting_letter', 'service/meeting_letter_form') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Service Request</p>

                    </a>
                    {{-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ Route('registration.rule1') }}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Support letter requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('registration.rule2') }}" class="nav-link ">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Adress Change Requests</p>
                            </a>
                        </li>
                    </ul> --}}
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notification</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('representative.profile') }}"
                        class="nav-link {{ Request::is('representative/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('representative.changePassword') }}"
                        class="nav-link {{ Request::is('representative/changePassword') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('representative.login') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li> --}}
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
