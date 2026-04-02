<nav class="navbar navbar-expand-lg navbar-modern sticky-top">
    <div class="container">

       <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="/img/logo/ARH.png" alt="Logo" height="40" class="logo-img me-2">

            <div class="brand-text">
                <span class="title">SMA Arif Rahman Hakim</span>
                <span class="subtitle">Terakreditasi “A”</span>
            </div>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain"
                aria-controls="navbarMain"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarMain">

            {{-- Menu Tengah --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                {{-- Profil --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('profil.*') ? 'active' : '' }}" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                        <li><a class="dropdown-item" href="{{ route('profil.sambutan') }}">Sambutan Kepala Sekolah</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.visi-misi') }}">Visi Misi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.struktur-organisasi') }}">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.fasilitas') }}">Fasilitas</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.guru') }}">Guru</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.staf') }}">Tenaga Kependidikan</a></li>
                    </ul>
                </li>

                {{-- Berita --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('berita.*') ? 'active' : '' }}"
                       href="#"
                       id="beritaDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Berita
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="beritaDropdown">
                        <li><a class="dropdown-item" href="{{ route('berita.artikel') }}">Artikel</a></li>
                        <li><a class="dropdown-item" href="{{ route('berita.pengumuman') }}">Pengumuman</a></li>
                    </ul>
                </li>

                {{-- Siswa --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('kesiswaan.*') ? 'active' : '' }}"
                       href="#"
                       id="siswaDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Kesiswaan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="siswaDropdown">
                        <li><a class="dropdown-item" href="{{ route('kesiswaan.alumni') }}">Alumni</a></li>
                        <li><a class="dropdown-item" href="{{ route('kesiswaan.ekstrakulikuler') }}">Ekstrakulikuler</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active fw-semibold' : '' }}"
                       href="{{ route('kontak') }}">
                        Kontak
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pendaftaran') ? 'active fw-semibold' : '' }}"
                       href="{{ route('pendaftaran') }}">
                        SPMB
                    </a>
                </li>

            </ul>


            {{-- USER --}}
            <div class="navbar-user-section">
                @auth
                <div class="dropdown">
                    <button class="btn btn-user-menu dropdown-toggle" id="userMenuDropdown" data-bs-toggle="dropdown"> 
                        <span class="user-avatar"><i class="bi bi-person-circle"></i></span>
                        <span class="user-name">{{ auth()->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user">
                        <li class="dropdown-header">
                            <div class="user-info">
                                <div class="user-avatar-large">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="user-details">
                                    <strong>{{ auth()->user()->name }}</strong>
                                    <small>{{ auth()->user()->email }}</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="{{ route('filament.admin.pages.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
