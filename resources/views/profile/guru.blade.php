@extends('layouts.app', [
    'title' => 'Guru',
])

@section('content')
    <div>
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Guru'
        ])

<div class="container py-5">  
  <div class="container-guru">
    @foreach ($guru as $guru)
      <div class="card-guru">
            <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">{{ $guru->nama }}</div>
            </div>
        </div>
    @endforeach
    </div>
</div>

    </div>
@endsection
