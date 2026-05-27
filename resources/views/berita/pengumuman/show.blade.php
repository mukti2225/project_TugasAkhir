@extends('layouts.app', [
    'title' => $pengumuman->judul . ' - ',
])

@section('content')
    <section class="section-padding-100-0 mb-50">
        @include('components.page-header', [
            'title' => 'Pengumuman',
        ])

        <div class="container-fluid pengumuman-show">
            <div class="container">
                <div class="pengumuman-show-wrapper">

                    {{-- Cover image --}}
                    <div class="pengumuman-cover">
                        <img src="{{ asset('img/logo/Pengumuman.png') }}" alt="{{ $pengumuman->judul }}">
                    </div>

                    {{-- Content card --}}
                    <div class="pengumuman-content-card">

                        {{-- Meta --}}
                        <div class="pengumuman-meta">
                            <span class="badge-kategori-pengumuman">
                                <i class="bi bi-megaphone-fill me-1"></i> Pengumuman
                            </span>
                            <span class="pengumuman-date">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $pengumuman->created_at->format('d F Y') }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h1 class="pengumuman-title">{{ $pengumuman->judul }}</h1>

                        <hr class="pengumuman-divider">

                        {{-- Body / konten --}}
                        @if ($pengumuman->konten ?? ($pengumuman->deskripsi ?? null))
                            <div class="pengumuman-body">
                                {!! $pengumuman->konten ?? $pengumuman->deskripsi !!}
                            </div>
                        @endif

                        {{-- Download PDF --}}
                        @if ($pengumuman->file_pdf)
                            <div class="pengumuman-attachment">
                                <div class="attachment-label">
                                    <i class="bi bi-paperclip"></i> Lampiran
                                </div>
                                <a href="{{ asset('storage/' . $pengumuman->file_pdf) }}" class="attachment-btn" download>
                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                    <span>Download PDF</span>
                                    <i class="bi bi-download ms-auto"></i>
                                </a>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
