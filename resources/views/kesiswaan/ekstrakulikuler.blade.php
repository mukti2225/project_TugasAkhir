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
        </div>
    </div>
@endsection
