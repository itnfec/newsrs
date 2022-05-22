<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link navbar-primary">
        <img src="{{ $pengaturan->logo != null ? asset('storage/' . $pengaturan->logo) : '/assets/img/logo.svg' }}" alt="AdminLTE Logo" class="brand-image img-circle"
           style="opacity: .8">
        <span class="brand-text text-light">{{ $pengaturan->nama_institusi }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/assets/img/user.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->nama }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">
                    UJIAN
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftar-ujian') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Daftar Ujian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('riwayat-ujian') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Riwayat Ujian</p>
                    </a>
                </li>

                <li class="nav-header">
                    PENGATURAN
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Ganti Password
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
