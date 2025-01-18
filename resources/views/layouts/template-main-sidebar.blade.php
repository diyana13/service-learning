<aside class="main-sidebar sidebar-light-maroon  elevation-4">
    <!-- Brand Logo -->
    <p class="brand-link">
        <img src="{{ asset('template') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text"><b>{{ config('app.name') }}</b></span>
    </p>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
                @auth
                    {{-- Lecturer Sidebar --}}
                    @if (Auth::user()->getRoleNames()->first() == 'lecturer')
                        <li class="nav-item">
                            <a href="{{ route('lecturer.home') }}" class="nav-link {{ Request::segment(2) == 'home' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
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
                    {{-- Assessor Sidebar --}}
                    @if (Auth::user()->getRoleNames()->first() == 'assessor')
                        <li class="nav-item">
                            <a href="{{ route('assessor.home') }}" class="nav-link {{ Request::segment(2) == 'home' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('assessor.project-list') }}" class="nav-link {{ Request::segment(2) == 'projects' ? 'active' : '' }}">
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