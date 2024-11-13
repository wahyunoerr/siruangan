<!DOCTYPE html>
<html lang="en">

@include('layouts.landing.head')

<body onload="hidePreloader()">

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand ms-3" href="{{ route('landing') }}">Ruangan<span class="text-primary">.</span></a>
        <a class="btn btn-outline-secondary me-3" href="{{ route('login') }}">Login</a>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>
    @include('layouts.landing.footer')

    @include('layouts.landing.script')
</body>

</html>
