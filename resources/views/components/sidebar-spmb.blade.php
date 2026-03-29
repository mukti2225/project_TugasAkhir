<!-- Sidebar -->
    <div class="col-lg-3">
      <div class="list-group shadow-sm">
        <div class="list-group-item bg-primary text-white fw-bold border-0">LAMAN SPMB ONLINE</div>
        <a href="{{ route('pendaftaran') }}" class="list-group-item list-group-item-action border-start-0 border-end-0 {{ request()->routeIs('pendaftaran') ? 'active' : '' }}">
          <i class="bi bi-file-text me-2"></i>Pendaftaran
        </a>
        <a href="{{ route('pendaftaran.cek') }}" class="list-group-item list-group-item-action border-start-0 border-end-0 {{ request()->routeIs('pendaftaran.cek') ? 'active' : '' }}">
          <i class="bi bi-search me-2"></i>Cek Pengumuman
        </a>
      </div>
      
      <!-- Info Card -->
      <div class="card bg-light mt-4 p-3 shadow-sm">
        <div class="card-body-spmb">
          <h6 class="fw-bold text-primary mb-2">
            <i class="bi bi-info-circle-fill me-1"></i> Informasi Penting
          </h6>
          <p class="small text-muted mb-0">
            {{ $infoText ?? 'Default Text' }}
          </p>
        </div>
      </div>
    </div>