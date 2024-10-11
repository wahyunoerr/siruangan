<div class="container-fluid d-flex justify-content-between">
    <nav class="pull-left">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="http://www.themekita.com">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"> Account </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <div class="copyright">
        <a href="{{ route('dashboard') }}">Sistem Informasi Pemesanan Ruangan,</a>
        {{ now()->format('F Y') }}
    </div>
    <div>
        Design by
        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
    </div>
</div>
