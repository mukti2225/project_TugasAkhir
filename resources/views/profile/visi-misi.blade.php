@extends('layouts.app', [
    'title' => 'Visi Misi - ',
])

@section('content')
    <div>
        @include('components.page-header', [
            'title' => 'Visi Misi',
        ])

        <section class="visi-misi">
            <div class="visi-misi-container">
                @if ($visiMisi)
                    {{-- ── VISI ── --}}
                    <div class="visi-block">
                        <div class="visi-block-inner">
                            <div class="visi-block-label">
                                <div class="visi-icon-wrap" aria-hidden="true">
                                    <i class="bi bi-eye"></i>
                                </div>
                                <div class="visi-label-text">
                                    Visi
                                    <small>Vision</small>
                                </div>
                            </div>
                            <div class="visi-text">
                                {!! $visiMisi->visi !!}
                            </div>
                        </div>
                    </div>

                    {{-- ── MISI ── --}}
                    <div class="misi-block">
                        <div class="misi-block-label">
                            <div class="misi-icon-wrap" aria-hidden="true">
                                <i class="bi bi-bullseye"></i>
                            </div>
                            <div class="misi-label-text">
                                Misi
                                <small>Mission</small>
                            </div>
                        </div>
                        <div class="misi-grid">
                            {!! $visiMisi->misi !!}
                        </div>
                    </div>
                @else
                    <div class="text-center py-3">
                        <h4 class="fw-bold">Visi Misi belum tersedia</h4>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
