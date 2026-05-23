@extends('layouts.app', [
    'title' => 'Fasilitas - ',
])

@section('content')
    <div>
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Fasilitas Sekolah',
        ])

        <div class="container fasilitas">
            @if ($fasilitas->count())
                <div class="fasilitas-grid">
                    @foreach ($fasilitas as $fasilitas)
                        <div class="card-fasilitas" data-nama="{{ $fasilitas->nama }}"
                            data-foto="{{ asset('storage/' . $fasilitas->foto) }}">
                            <img src="{{ asset('storage/' . $fasilitas->foto) }}">
                            <div class="overlay">
                                <h5>{{ $fasilitas->nama }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-3">
                    <h4 class="fw-bold">Data Fasilitas belum tersedia</h4>
                </div>
            @endif
        </div>

        <!-- Modal -->
        <div class="modal-fasilitas" id="modalFasilitas">
            <div class="modal-fasilitas_backdrop" id="modalBackdrop"></div>
            <div class="modal-fasilitas_box">
                <button class="modal-fasilitas_close" id="modalClose">&times;</button>
                <img src="" alt="" id="modalImg" class="modal-fasilitas_img">
                <div class="modal-fasilitas_body">
                    <h3 id="modalNama"></h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const modal = document.getElementById('modalFasilitas');
        const modalImg = document.getElementById('modalImg');
        const modalNama = document.getElementById('modalNama');
        const modalClose = document.getElementById('modalClose');
        const backdrop = document.getElementById('modalBackdrop');

        document.querySelectorAll('.card-fasilitas').forEach(card => {
            card.addEventListener('click', () => {
                modalImg.src = card.dataset.foto;
                modalImg.alt = card.dataset.nama;
                modalNama.textContent = card.dataset.nama;
                modal.classList.add('active');
            });
        });

        modalClose.addEventListener('click', () => modal.classList.remove('active'));
        backdrop.addEventListener('click', () => modal.classList.remove('active'));
    </script>
@endpush
