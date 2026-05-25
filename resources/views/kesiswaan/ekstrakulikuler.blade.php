@extends('layouts.app', [
    'title' => 'Ekstrakulikuler - ',
])

@section('content')
    <!-- Header -->
    @include('components.page-header', [
        'title' => 'Ekstrakulikuler',
    ])

    <div class="container py-3">
        <div class="ekstrakulikuler">

            @if ($ekstrakulikuler->count())
                <div class="grid">
                    @foreach ($ekstrakulikuler as $item)
                        <div class="card">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">

                            <div class="overlay">
                                <h3>{{ $item->nama }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <h3 class="fw-bold mb-2">
                        Data ekstrakulikuler belum tersedia
                    </h3>
                </div>
            @endif

        </div>
    </div>
@endsection
