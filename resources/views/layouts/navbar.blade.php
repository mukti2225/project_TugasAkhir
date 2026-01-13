<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('templates/frontend') }}/img/main/ARH.png" alt="" height="30" class="me-2">
            Arif Rahman Hakim
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-3 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}"
                       href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarlightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil</a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarlightDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('profil.sekolah') }}">Profil Sekolah</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.visi-misi') }}">Visi Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.sejarah-singkat') }}">Sejarah Singkat</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.struktur-organisasi') }}">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.fasilitas') }}">Fasilitas</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.staf-pengajar') }}">Staff Pengajar</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.staf-pendidik') }}">Staff Tenaga Kependidikan</a></li>
                        </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarlightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Berita</a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarlightDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('artikel') }}">Artikel</a></li>
                            <li><a class="dropdown-item" href="#">Pengumuman</a></li>
                        </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarlightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Siswa</a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarlightDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Alumni</a></li>
                            <li><a class="dropdown-item" href="#">Ekstrakulikuler</a></li>
                        </ul>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active fw-semibold' : '' }}"
                       href="{{ route('kontak') }}">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pendaftaran.form') ? 'active fw-semibold' : '' }}"
                       href="{{ route('pendaftaran.form') }}">Pendaftaran</a>
                </li>
            </ul>

            {{-- USER --}}
            @auth
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle text-decoration-none"
                        id="userName"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{-- <i class="bi bi-person-circle fs-5"></i> --}}
                    {{ auth()->user()->name }}
                </button>

                <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="userName">
                    <li>
                        @role('admin')
                            <a class="dropdown-item" href="{{ route('filament.admin.pages.dashboard') }}">
                                Dashboard Admin
                            </a>
                        @elserole('user')
                            <a class="dropdown-item" href="{{ route('filament.user.pages.dashboard') }}">
                                Dashboard User
                            </a>
                        @endrole
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        @role('admin')
                            <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        @elserole('user')
                            <form method="POST" action="{{ route('filament.user.auth.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        @endrole
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </div>
</nav>
