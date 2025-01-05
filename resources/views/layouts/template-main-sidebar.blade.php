<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('template') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('template') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @auth
                    {{-- Lecturer Sidebar --}}
                    @if (Auth::user()->getRoleNames()->first() == 'lecturer')
                        <li class="nav-item">
                            <a href="{{ route('lecturer.home') }}" class="nav-link {{ Request::segment(2) == 'home' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lecturer.projects') }}" class="nav-link {{ Request::segment(2) == 'projects' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-tasks"></i>
                                <p>
                                    Projects
                                </p>
                            </a>
                        </li>
                    @endif

                    {{-- Student Sidebar --}}
                    @if (Auth::user()->getRoleNames()->first() == 'student')
                        <li class="nav-item">
                            <a href="{{ route('student.home') }}" class="nav-link {{ Request::segment(2) == 'home' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.student-project') }}" class="nav-link {{ Request::segment(2) == 'projects' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-tasks"></i>
                                <p>
                                    Projects
                                </p>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>