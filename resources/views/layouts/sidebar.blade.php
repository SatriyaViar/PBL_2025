<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/LogoJTI.png') }}" alt="Logo JTI" class="img-fluid" style="width: 70px; height: 40px;">

        </div>
        <div class="sidebar-brand-text mx-3">Akreditasi Polinema </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }} " href="{{ url('/') }}">
            <i class="fas fa-archway"></i>
            <span>Dashboard</span>
        </a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Data User -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataUser"
            aria-expanded="true" aria-controls="dataUser">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data User</span>
        </a>
        <div id="dataUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data User:</h6>
                <a class="collapse-item {{ $activeMenu == 'user' ? 'active' : '' }}" href="{{ asset('/user') }}">User Akreditasi</a>
                <a class="collapse-item" href="register.html">Level User Akreditasi</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Kriteria Akreditasi -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kriteria Akreditasi</span>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kriteria Akreditasi:</h6>
                <a class="collapse-item" href="login.html">Kriteria 1</a>
                <a class="collapse-item" href="login.html">Kriteria 2</a>
                <a class="collapse-item" href="login.html">Kriteria 3</a>
                <a class="collapse-item" href="login.html">Kriteria 4</a>
                <a class="collapse-item" href="login.html">Kriteria 5</a>
                <a class="collapse-item" href="login.html">Kriteria 6</a>
                <a class="collapse-item" href="login.html">Kriteria 7</a>
                <a class="collapse-item" href="login.html">Kriteria 8</a>
                <a class="collapse-item" href="login.html">Kriteria 9</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->
