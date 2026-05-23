@extends('layouts.app', [
    'title' => 'Guru - ',
])

@section('content')
    <div>
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Guru & Tenaga Pendidik',
        ])

        <div class="guru">
            @if ($guru->count())
                <div class="guru-grid">
                    @foreach ($guru as $guru)
                        <div class="guru-card">
                            <div class="guru-card_photo">
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto {{ $guru->nama }}">
                            </div>
                            <div class="guru-card_body">
                                <div class="guru-card_name">{{ $guru->nama }}</div>
                                <div class="guru-card_nip">NIP: {{ $guru->nip }}</div>

                                @if ($guru->jabatan)
                                    <span class="guru-card_badge guru-card_badge-jabatan">
                                        {{ $guru->jabatan }}
                                    </span>
                                @endif
                                @if ($guru->status)
                                    <span class="guru-card_badge guru-card_badge-status">
                                        {{ $guru->status }}
                                    </span>
                                @endif

                                <ul class="guru-card_info">
                                    @if ($guru->mata_pelajaran)
                                        <li>
                                            <span class="guru-card_info-icon">📚</span>
                                            {{ $guru->mata_pelajaran }}
                                        </li>
                                    @endif
                                    @if ($guru->pendidikan)
                                        <li>
                                            <span class="guru-card_info-icon">🎓</span>
                                            {{ $guru->pendidikan }}
                                        </li>
                                    @endif
                                    <li>
                                        <span class="guru-card_info-icon">📞</span>
                                        {{ $guru->telepon ?? '-' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-3">
                    <h4 class="fw-bold">Data Guru belum tersedia</h4>
                </div>
            @endif
        </div>

    </div>
@endsection
