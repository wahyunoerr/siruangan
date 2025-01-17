<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            @hasrole('Administrator')
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
            @endhasrole
            @hasrole('Administrator')
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master Data</h4>
                </li>
                <li class="nav-item {{ Request::is('event/*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-birthday-cake"></i>
                        <p>Event</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('event/*') ? 'show' : '' }}" id="tables">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::is('ruangan/*') ? 'active' : '' }}">
                                <a href="{{ route('acara.index') }}">
                                    <span class="sub-item">Data Event</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Landing Page</h4>
                </li>
                <li class="nav-item {{ Request::is('landing/*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#landing">
                        <i class="fas fa-globe"></i>
                        <p>Landing Page</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('landing/*') ? 'show' : '' }}" id="landing">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::is('landing/*') ? 'active' : '' }}">
                                <a href="{{ route('landing.manage') }}">
                                    <span class="sub-item">Manage Landing Page</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endhasrole

            @hasrole('Perlengkapan')
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
            @endrole

            @hasanyrole('Administrator|Perlengkapan')
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Boking Data</h4>
                </li>
                <li class="nav-item {{ Request::is('dataBoking/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dataBooking') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Boking Ruangan</p>
                    </a>
                </li>
            @endhasanyrole
            @hasrole('Costumer')
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Pengajuan Booking Anda</h4>
                </li>
                <li class="nav-item {{ Request::is('booking-costumer/*') ? 'active' : '' }}">
                    <a href="{{ route('pengajuan.booking') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Booking</p>
                    </a>
                </li>
            @endhasrole

            @hasrole('Administrator')
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Transaksi Data</h4>
                </li>
                <li class="nav-item {{ Request::is('transaksi/*') ? 'active' : '' }}">
                    <a href="{{ route('transaksi') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
            @endrole
        </ul>
    </div>
</div>

@auth
    <img src="{{ 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=000&color=FDFDFD&rounded=true' }}"
        alt="..." class="avatar-img rounded-circle" />
@endauth
