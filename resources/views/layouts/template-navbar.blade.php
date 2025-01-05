<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @auth
            @if (Auth::user()->getRoleNames()->first() == 'lecturer')
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('lecturer.home') }}" class="nav-link">Home</a>
                </li>
            @endif
            @if (Auth::user()->getRoleNames()->first() == 'student')
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('student.home') }}" class="nav-link">Home</a>
                </li>
            @endif
            @if (Auth::user()->getRoleNames()->first() == 'assessor')
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('assessor.home') }}" class="nav-link">Home</a>
                </li>
            @endif
        @endauth


        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home')}}" class="nav-link">Home</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>