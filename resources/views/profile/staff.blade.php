@extends('layouts.app', [
    'title' => 'Staff Pendidik',
])

@section('content')
    <div>

        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Tenaga Kependidikan'
        ])


<div class="container staff"> 
    @if($staff->count())
    <div class="container">
        @foreach ($staff as $staff)
        <div class="card">
                <img src="{{ asset('storage/' . $staff->foto) }}" alt="Foto staff">
                <div class="card-body">
                    <div class="name">{{ $staff->nama }}</div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-3">
        <h4 class="fw-bold">Data tenaga kependidikan belum tersedia</h4>
    </div>
    @endif
</div>

    </div>
@endsection
