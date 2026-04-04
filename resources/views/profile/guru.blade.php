@extends('layouts.app', [
    'title' => 'Guru',
])

@section('content')
    <div>
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Guru'
        ])

<div class="container guru">
    @if($guru->count())
        <div class="container">
            @foreach ($guru as $guru)
                <div class="card">
                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru">
                    <div class="card-body">
                        <div class="name">{{ $guru->nama }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <h3 class="fw-bold">Data guru belum tersedia</h3>
        </div>
    @endif
</div>

    </div>
@endsection
