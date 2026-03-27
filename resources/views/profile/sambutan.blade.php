@extends('layouts.app', [
    'title' => 'Sambutan Kepala Sekolah',
])

@section('content')
    <div>

        @include('components.page-header', [
            'title' => 'Sambutan Kepala Sekolah'
        ])

        <!-- Content -->
        <div class="container py-5">
            <div class="row align-items-center">

                 <!-- Text -->
                <div class="col-md-7 order-2 order-md-1">
                    <h3 class="fw-bold">{{ $statistik->name }}</h3>
                    <p class="text-muted mb-3">{{ $statistik->position }}</p>

                    <p style="text-align: justify;">
                        {{ $statistik->sambutan ?? 'Sambutan belum tersedia.' }}
                    </p>
                </div>

                <!-- Image -->
                <div class="col-md-5 text-center mb-4 mb-md-0 order-1 order-md-2">
                    <div class="img-sambutan">
                        <img src="{{ asset('storage/' . $statistik->photo) }}" alt=" Kepala Sekolah" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
