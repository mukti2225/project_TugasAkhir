@extends('layouts.app', [
    'title' => 'Ekstrakulikuler - ',
])

@section('content')
    @include('components.page-header', [
        'title' => 'Ekstrakulikuler',
    ])

    <div class="kesiswaan-page ek-page-wrapper">
        <div class="ek-section">
            @if ($ekstrakulikuler->count())
                {{-- Header --}}
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-2">Kegiatan Siswa</h2>
                    <p class="subtitle">Ekstrakulikuler Sekolah</p>
                </div>

                {{-- Grid --}}
                <div class="ek-grid">
                    @foreach ($ekstrakulikuler as $item)
                        <div class="ek-card" data-title="{{ $item->nama }}"
                            data-image="{{ asset('storage/' . $item->foto) }}" data-desc="{{ $item->deskripsi }}"
                            data-cat="{{ $item->kategori ?? 'Ekskul' }}" data-jadwal="{{ $item->jadwal ?? '' }}">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="ek-card-img"
                                loading="lazy">
                            <span class="ek-badge">{{ $item->kategori ?? 'Ekskul' }}</span>
                            <div class="ek-overlay">
                                <h3 class="ek-title">{{ $item->nama }}</h3>
                                <span class="ek-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                    Lihat Detail
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="ek-empty">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                        stroke="#ccc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <path d="M9 9h6M9 13h4" />
                    </svg>
                    <p>Data ekstrakulikuler belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal --}}
    <div id="ekModal" class="ek-modal" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="ek-modal-backdrop" id="ekModalBackdrop"></div>
        <div class="ek-modal-dialog">
            <button class="ek-modal-close" id="ekModalClose" aria-label="Tutup">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
            </button>
            <div class="ek-modal-inner">
                <div class="ek-modal-img-wrap">
                    <img src="" id="modalImg" class="ek-modal-img" alt="">
                    <span class="ek-modal-badge" id="modalBadge"></span>
                </div>
                <div class="ek-modal-body">
                    <p class="ek-modal-cat" id="modalCat"></p>
                    <h3 id="modalTitle" class="ek-modal-title"></h3>
                    <div class="ek-modal-divider"></div>
                    <div id="modalDesc" class="ek-modal-desc"></div>
                    <div class="ek-modal-meta" id="modalJadwal" style="display:none;">
                        <span id="modalJadwalText"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('ekModal');
            var backdrop = document.getElementById('ekModalBackdrop');
            var closeBtn = document.getElementById('ekModalClose');
            var titleEl = document.getElementById('modalTitle');
            var imgEl = document.getElementById('modalImg');
            var descEl = document.getElementById('modalDesc');
            var jadwalEl = document.getElementById('modalJadwal');
            var jadwalText = document.getElementById('modalJadwalText');
            var badgeEl = document.getElementById('modalBadge');
            var catEl = document.getElementById('modalCat');

            function openModal(card) {
                titleEl.textContent = card.getAttribute('data-title') || '';
                imgEl.src = card.getAttribute('data-image') || '';
                imgEl.alt = card.getAttribute('data-title') || '';
                badgeEl.textContent = card.getAttribute('data-cat') || '';
                catEl.textContent = card.getAttribute('data-cat') || '';
                descEl.innerHTML = (card.getAttribute('data-desc') || '').replace(/\n/g, '<br>');
                var jadwal = card.getAttribute('data-jadwal') || '';
                if (jadwal) {
                    jadwalText.textContent = jadwal;
                    jadwalEl.style.display = 'flex';
                } else {
                    jadwalEl.style.display = 'none';
                }
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.classList.remove('active');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                setTimeout(function() {
                    imgEl.src = '';
                }, 300);
            }

            document.querySelectorAll('.ek-card').forEach(function(card) {
                card.addEventListener('click', function() {
                    openModal(card);
                });
            });

            closeBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeModal();
            });
        });
    </script>
@endpush
