<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('DashboardUser') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIFOLAB<sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ $menuDashboard ?? '' }}">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard User</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengguna
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ $menuAdminUser ?? '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user"></i>
                    <span>Kelola Pengguna User</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelompok Pengguna:</h6>
                        {{-- <a class="collapse-item" href="{{ route('user') }}">Admin</a> --}}
                        <a class="collapse-item" href="cards.html">User</a>
                    </div>
                </div>
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
                {{-- <a class="nav-link" href="{{ route('alat') }}"> --}}
                    <i class="fas fa-fw fa-table"></i>
                    <span>Daftar Alat</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuAdminBahan ?? '' }}">
                {{-- <a class="nav-link" href="{{ route('bahan') }}"> --}}
                    <i class="fas fa-fw fa-table"></i>
                    <span>Daftar Bahan</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuAdminJadwal ?? '' }}">
                {{-- <a class="nav-link" href="{{ route('jadwal') }}"> --}}
                    <i class="fas fa-fw fa-table"></i>
                    <span>Jadwal</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
