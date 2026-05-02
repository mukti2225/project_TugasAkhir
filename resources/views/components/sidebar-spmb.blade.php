<!-- Sidebar -->
<div class="col-lg-3">

    {{-- Nav Card --}}
    <div class="sidebar-nav-card">
        <div class="sidebar-nav-header">
            <div class="sidebar-nav-header-icon">
                <i class="bi bi-layout-text-sidebar-reverse"></i>
            </div>
            <span>Laman SPMB Online</span>
        </div>

        <a href="{{ route('pendaftaran') }}"
           class="sidebar-nav-item {{ request()->routeIs('pendaftaran') ? 'active' : '' }}">
            <div class="sidebar-nav-icon icon-blue">
                <i class="bi bi-file-text"></i>
            </div>
            <span>Pendaftaran</span>
            <i class="bi bi-chevron-right ms-auto sidebar-arrow"></i>
        </a>

        <a href="{{ route('pendaftaran.cek') }}"
           class="sidebar-nav-item {{ request()->routeIs('pendaftaran.cek') ? 'active' : '' }}">
            <div class="sidebar-nav-icon icon-purple">
                <i class="bi bi-search"></i>
            </div>
            <span>Cek Pengumuman</span>
            <i class="bi bi-chevron-right ms-auto sidebar-arrow"></i>
        </a>
    </div>

    {{-- Info Card --}}
    <div class="sidebar-info-card mt-3">
        <div class="sidebar-info-header">
            <div class="sidebar-info-badge">
                <i class="bi bi-info-circle-fill"></i>
            </div>
            <span>Informasi Penting</span>
        </div>
        <div class="sidebar-info-body">
            <p>{{ $infoText ?? 'Default Text' }}</p>
        </div>
    </div>

</div>