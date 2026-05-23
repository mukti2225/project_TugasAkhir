@extends('layouts.app', [
    'title' => $artikel->judul . ' - ',
])

@section('content')
    <div class="detail-artikel-wrapper">

        {{-- Breadcrumb --}}
        <div class="detail-artikel-breadcrumb">
            <a href="/">Beranda</a>
            <span>›</span>
            <a href="{{ route('berita.artikel') }}">Berita & Artikel</a>
            <span>›</span>
            <span class="detail-artikel-breadcrumb-active">
                {{ Str::limit($artikel->judul, 22) }}
            </span>
        </div>

        {{-- Kategori --}}
        <div class="detail-artikel-kategori">
            <span>{{ strtoupper($artikel->kategoriArtikel->nama_kategori) }}</span>
        </div>

        {{-- Judul --}}
        <h2 class="detail-artikel-judul">
            {{ $artikel->judul }}
        </h2>

        {{-- Meta --}}
        <div class="detail-artikel-meta">
            <div class="detail-artikel-meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                </svg>
                <span>{{ $artikel->created_at->translatedFormat('d F Y') }}</span>
            </div>

            <div class="detail-artikel-meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                @php
                    $wordCount = str_word_count(strip_tags($artikel->deskripsi));
                    $readMin = max(1, ceil($wordCount / 200));
                @endphp
                <span>{{ $readMin }} menit baca</span>
            </div>
        </div>

        {{-- Thumbnail --}}
        <div class="detail-artikel-thumbnail">
            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" loading="lazy">
        </div>

        {{-- Content --}}
        <div class="detail-artikel-content">
            <p>
                {!! $artikel->deskripsi !!}
            </p>
        </div>

        {{-- Share --}}
        <div class="detail-artikel-share">

            <div class="detail-artikel-share-title">Bagikan Artikel</div>

            <div class="detail-artikel-share-list">
                <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' ' . request()->fullUrl()) }}" target="_blank"
                    rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="currentColor" style="color:#25D366">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                        <path
                            d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.121 1.532 5.849L.057 23.887a.75.75 0 00.916.942l6.218-1.456A11.946 11.946 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.87 0-3.627-.492-5.148-1.352l-.37-.215-3.839.9.942-3.71-.237-.382A9.955 9.955 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                    </svg>
                    WhatsApp
                </a>

                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($artikel->judul) }}"
                    target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.741l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                    </svg>
                    Twitter
                </a>

                <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                    Instagram
                </a>

                <button onclick="copyArtikelLink()" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2" />
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                    </svg>
                    Salin Link
                </button>
            </div>
        </div>

        {{-- Artikel Lainnya --}}
        <div class="detail-artikel-rekomendasi">
            <h3 class="detail-artikel-rekomendasi-title">Artikel Lainnya</h3>
            <div class="detail-artikel-rekomendasi-grid">
                @php
                    $rekomendasi = \App\Models\Artikel::where('id', '!=', $artikel->id)->latest()->take(3)->get();
                @endphp
                @foreach ($rekomendasi as $item)
                    <a href="{{ route('berita.artikel.show', $item->slug) }}" class="detail-artikel-card">
                        <div class="detail-artikel-card-image">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}"
                                loading="lazy">
                        </div>
                        <div class="detail-artikel-card-body">
                            <div class="detail-artikel-card-kategori">
                                {{ strtoupper($item->kategoriArtikel->nama_kategori) }}
                            </div>
                            <div class="detail-artikel-card-judul">
                                {{ Str::limit($item->judul, 60) }}
                            </div>
                            <div class="detail-artikel-card-date">
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function copyArtikelLink() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                const btn = document.querySelector('.detail-artikel-share-list button');
                const original = btn.innerHTML;
                btn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Tersalin!
                `;
                btn.style.background = '#f0fdf4';
                btn.style.borderColor = '#86efac';
                btn.style.color = '#16a34a';
                setTimeout(function() {
                    btn.innerHTML = original;
                    btn.style.background = '';
                    btn.style.borderColor = '';
                    btn.style.color = '';
                }, 2000);
            }).catch(function() {
                const textArea = document.createElement('textarea');
                textArea.value = window.location.href;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
            });
        }
    </script>
@endsection
