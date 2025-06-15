<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/LogoJTI.png') }}" alt="Logo JTI" class="img-fluid" style="width: 70px; height: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">Akreditasi Polinema</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}" href="{{ url('/dashboard') }}">
            <i class="fas fa-archway"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    @if(auth()->user()->level_id == 1)
        <!-- Data User (Admin Only) -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataUser" aria-expanded="true"
                aria-controls="dataUser">
                <i class="fas fa-fw fa-folder"></i>
                <span>Data User</span>
            </a>
            <div id="dataUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data User:</h6>
                    <a class="collapse-item {{ $activeMenu == 'user' ? 'active' : '' }}" href="{{ asset('/user') }}">User Akreditasi</a>
                    <a class="collapse-item {{ $activeMenu == 'level' ? 'active' : '' }}" href="{{ asset('/level') }}">Level User Akreditasi</a>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">
    @endif

    @if(auth()->user()->level_id == 2)
        <!-- Kriteria Akreditasi (Koordinator Only) -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kriteriaAkreditasi"
                aria-expanded="true" aria-controls="kriteriaAkreditasi">
                <i class="fas fa-fw fa-folder"></i>
                <span>Kriteria Akreditasi</span>
            </a>
            <div id="kriteriaAkreditasi" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kriteria Akreditasi:</h6>
                    <a class="collapse-item {{ $activeMenu == 'kriteria' ? 'active' : '' }}"
                        href="{{ asset('/kriteria') }}">Kriteria Akreditasi</a>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <!-- Kriteria PPEP (Koordinator Only) -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kriteriaAkreditasiPPEP"
                aria-expanded="true" aria-controls="kriteriaAkreditasiPPEP">
                <i class="fas fa-fw fa-folder"></i>
                <span>Kriteria Akreditasi PPEP</span>
            </a>
            <div id="kriteriaAkreditasiPPEP" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kriteria Akreditasi:</h6>
                    <div id="ppep-sidebar-container">
                        @include('partials.sidebar_kriteria', ['kriteriaList' => $kriteriaList])
                    </div>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">
    @endif

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ url('logout') }}" method="GET" class="d-none">
            @csrf
        </form>
    </li>

</ul>
<!-- End of Sidebar -->
