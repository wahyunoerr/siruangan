<!DOCTYPE html>
<html lang="en">

@include('layouts.landing.head')

<body onload="hidePreloader()">
    @include('sweetalert::alert')
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand ms-3" href="{{ route('landing') }}">Ruangan<span class="text-primary">.</span></a>
        @auth
            @hasrole('Administrator')
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
            @endhasrole
            @hasrole('Costumer')
                <a href="{{ route('pengajuan.booking') }}" class="btn btn-outline-secondary">Dashboard</a>
            @endhasrole
        @else
            <a class="btn btn-outline-secondary me-3" href="{{ route('login') }}">Login</a>
        @endauth
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>
    @include('layouts.landing.footer')

    @include('layouts.landing.script')
</body>

</html>
