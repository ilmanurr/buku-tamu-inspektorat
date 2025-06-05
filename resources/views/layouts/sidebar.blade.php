<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo-inspektorat2.png') }}" alt="Logo Inspektorat"
                style="width: 40px; height: auto;">
        </div>
        <div class="sidebar-brand-text mx-3">Inspektorat Jawa Timur</div>
    </a>
    <hr class="sidebar-divider my-0">

    <!-- Menu di sidebar jika user yang login memiliki role Monitor -->
    @if(Auth::check() && Auth::user()->hasRole('monitor'))
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('monitor.bukutamu') }}">
            <i class="fas fa-desktop"></i>
            <span>Monitor Buku Tamu</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('monitor.lookups') }}">
            <i class="fas fa-desktop"></i>
            <span>Monitor Lookups</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-file-alt"></i>
            <span>Report</span>
        </a>
    </li>

    <!-- Menu di sidebar jika user yang login memiliki role Resepsionis -->
    @elseif(Auth::check() && Auth::user()->hasRole('resepsionis'))
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('bukutamu.create') }}">
            <i class="fas fa-user-plus"></i>
            <span>Form Tamu</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('bukutamu.index') }}">
            <i class="fas fa-book-open"></i>
            <span>Buku Tamu</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('lookups.index') }}">
            <i class="fas fa-list-alt"></i>
            <span>Lookups</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('kartu_akses.index') }}">
            <i class="fas fa-id-card"></i>
            <span>Kartu Akses</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-file-alt"></i>
            <span>Report</span>
        </a>
    </li>

    <!-- Menu di sidebar jika user yang login memiliki role Super Admin -->
    @else
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('bukutamu.create') }}">
            <i class="fas fa-user-plus"></i>
            <span>Form Tamu</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('bukutamu.index') }}">
            <i class="fas fa-book-open"></i>
            <span>Buku Tamu</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('lookups.index') }}">
            <i class="fas fa-list-alt"></i>
            <span>Lookups</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users-cog"></i>
            <span>Manajemen User</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('kartu_akses.index') }}">
            <i class="fas fa-id-card"></i>
            <span>Kartu Akses</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-file-alt"></i>
            <span>Report</span>
        </a>
    </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>