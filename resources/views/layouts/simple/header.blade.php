<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Auth::user()->avatar ? asset('/storage/images/'.Auth::user()->avatar) : asset('images/avatar.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-block float-right admin_name">{{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right rounded" style="width:0px;" aria-labelledby="navbarDropdown">
                <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
                <a class="dropdown-item" href = "{{ route('logout') }}" onclick = "event.preventDefault();document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
