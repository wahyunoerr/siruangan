<!DOCTYPE html>
<html lang="en">

@include('layouts.landing.head')

<body class="index-page">

    @include('layouts.landing.header')

    <main class="main">
        @yield('content')
    </main>

    @include('layouts.landing.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('layouts.landing.script')

</body>

</html>
