<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">HeroBiz</h1>
            <span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#services" class="active">Ruangan<br></a></li>
                {{-- <li><a href="#services">Ruangan</a></li> --}}
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @if (Route::has('login'))
            <div class="d-flex justify-content-between align-items-center">
                @auth
                    <a class="btn-getstarted" href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a class="btn btn-secondary ms-auto" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        @endif

    </div>
</header>
