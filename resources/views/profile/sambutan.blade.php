@extends('layouts.app', [
    'title' => 'Sambutan - ',
])

@section('content')
    <div>
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Sambutan Kepala Sekolah',
        ])

        <div class="container sambutan">
            <div class="row align-items-center">
                @if ($statistik)
                    <div class="col-md-7 order-2 order-md-1">
                        <h3 class="fw-bold">{{ $statistik->name }}</h3>
                        <p class="text-muted mb-3">{{ $statistik->position }}</p>

                        <div class="isi">
                            {!! $statistik->sambutan !!}
                        </div>
                    </div>

                    <div class="col-md-5 text-center mb-4 mb-md-0 order-1 order-md-2">
                        <div class="img-sambutan">
                            <img src="{{ asset('storage/' . $statistik->photo) }}" alt=" Kepala Sekolah" class="img-fluid">
                        </div>
                    </div>
                @else
                    <div class="text-center py-3">
                        <h4 class="fw-bold">Sambutan belum tersedia</h4>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
