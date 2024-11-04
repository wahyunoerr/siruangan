<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">User Management</h4>
            </li>

            <li class="nav-item {{ Request::is('user-management/*') ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#base">
                    <i class="fas fa-users"></i>
                    <p>Users</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ Request::is('user-management/*') ? 'show' : '' }}" id="base">
                    <ul class="nav nav-collapse">
                        <li class="{{ Request::is('user-management/*') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}">
                                <span class="sub-item">Users Data</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Master Data</h4>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#tables">
                    <i class="fas fa-birthday-cake"></i>
                    <p>Event</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="#">
                                <span class="sub-item">Data Event</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('ruangan/*') ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                    <i class="fas fa-building"></i>
                    <p>Ruangan</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ Request::is('ruangan/*') ? 'show' : '' }}" id="sidebarLayouts">
                    <ul class="nav nav-collapse">
                        <li class="{{ Request::is('ruangan/*') ? 'active' : '' }}">
                            <a href="{{ route('ruangan.index') }}">
                                <span class="sub-item">Data Ruangan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('jadwal/*') ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#forms">
                    <i class="fas fa-calendar"></i>
                    <p>Jadwal</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ Request::is('jadwal/*') ? 'show' : '' }}" id="forms">
                    <ul class="nav nav-collapse">
                        <li class="{{ Request::is('jadwal/*') ? 'active' : '' }}">
                            <a href="{{ route('jadwal.index') }}">
                                <span class="sub-item">Data Jadwal</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Penjadwalan Data</h4>
            </li>
            <li class="nav-item {{ Request::is('penjadwalan/*') ? 'active' : '' }}">
                <a href="{{ route('penjadwalan.index') }}">
                    <i class="fas fa-clipboard-list"></i>
                    <p>Penjadwalan Ruangan</p>
                </a>
            </li>

            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Transaksi Data</h4>
            </li>
            <li class="nav-item">
                <a href="../widgets.html">
                    <i class="fas fa-exchange-alt"></i>
                    <p>Transaksi</p>
                </a>
            </li>
        </ul>
    </div>
</div>
