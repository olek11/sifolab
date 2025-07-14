<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('DashboardAdmin') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIFOLAB<sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ $menuAdminDashboard ?? '' }}">
                <a class="nav-link" href="{{route('DashboardAdmin')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Pengguna
            </div>
            <li class="nav-item {{ $menuAdminUser ?? '' }}">
                <a class="nav-link" href="{{ route('admin.user') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            <!-- Nav Item - Utilities Collapse Menu Selesai -->
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Pengelolaan Lab
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
                <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuAdminAlat ?? '' }}">
                <a class="nav-link" href="{{ route('admin.alat') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Daftar Alat</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuAdminBahan ?? '' }}">
                <a class="nav-link" href="{{ route('admin.bahan') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Daftar Bahan</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuAdminJadwal ?? '' }}">
                <a class="nav-link" href="{{ route('admin.jadwal') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Jadwal</span></a>
            </li>
            <!-- Divider -->
            <li class="nav-item {{ $menuAdminPeminjamanAlat ?? '' }}">
                <a class="nav-link" href="{{ route('admin.peminjaman') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Peminjaman Alat</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
