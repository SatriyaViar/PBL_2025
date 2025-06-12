@php
    $activeMenu = $activeMenu ?? '';
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataUser" aria-expanded="true"
            aria-controls="dataUser">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data User</span>
        </a>
        <div id="dataUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data User:</h6>
                <a class="collapse-item {{ $activeMenu == 'user' ? 'active' : '' }}" href="{{ asset('/user') }}">User
                    Akreditasi</a>
                <a class="collapse-item {{ $activeMenu == 'level' ? 'active' : '' }}" href="{{ asset('/level') }}">Level
                    User Akreditasi</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Kriteria Akreditasi -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kriteriaAkreditasi"
            aria-expanded="true" aria-controls="kriteriaAkreditasis">
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

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kriteriaAkreditasiPPEP"
            aria-expanded="true" aria-controls="kriteriaAkreditasis">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kriteria Akreditasi PPEP</span>
        </a>
        <div id="kriteriaAkreditasiPPEP" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <div id="ppep-sidebar-container">
                    <!-- Data akan dimuat via JS -->
                </div>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <!-- Sidebar Penelitian - Untuk Koordinator/Admin -->

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penelitianKoordinatorMenu"
            aria-expanded="true" aria-controls="penelitianKoordinatorMenu">
            <i class="fas fa-fw fa-book"></i>
            <span>Penelitian Dosen</span>
        </a>
        <div id="penelitianKoordinatorMenu" class="collapse" aria-labelledby="headingPenelitianKoordinator"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Koordinator:</h6>
                <a class="collapse-item {{ $activeMenu == 'penelitian-koordinator' ? 'active' : '' }}"
                    href="{{ route('penelitian-dosen-koordinator.index') }}">
                    Daftar Penelitian
                </a>
            </div>
        </div>
    </li> --}}


    <!-- Sidebar Penelitian - Untuk Dosen -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penelitianDosenMenu"
            aria-expanded="true" aria-controls="penelitianDosenMenu">
            <i class="fas fa-fw fa-lightbulb"></i>
            <span>Penelitian Saya</span>
        </a>
        <div id="penelitianDosenMenu" class="collapse" aria-labelledby="headingPenelitianDosen"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Dosen:</h6>
                <a class="collapse-item {{ $activeMenu == 'penelitian-dosen' ? 'active' : '' }}"
                    href="{{ route('penelitian-dosen.index') }}">
                    Daftar Penelitian Saya
                </a>

            </div>
        </div>
    </li>


    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link text-danger"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
        </a>
    </li>

</ul>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function loadSidebarKriteria() {
        fetch('/sidebar/kriteria-ppep')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('ppep-sidebar-container');

                // Bersihkan dulu isi sebelumnya
                container.innerHTML = '<h6 class="collapse-header">Kriteria Akreditasi:</h6>';

                // Tambahkan link dari data
                data.forEach(item => {
                    const link = document.createElement('a');
                    link.className = 'collapse-item';
                    link.href = '/ppep/' + item.kriteria_id; // atur link sesuai kebutuhanmu
                    link.textContent = item.kriteria_nama;
                    container.appendChild(link);
                });

                const divider = document.createElement('div');
                divider.className = 'collapse-divider';
                container.appendChild(divider);
            });
    }

    document.addEventListener('DOMContentLoaded', loadSidebarKriteria);
</script>

<!-- End of Sidebar -->