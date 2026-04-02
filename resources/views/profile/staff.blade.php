@extends('layouts.app', [
    'title' => 'Staff Pendidik',
])

@section('content')
    <div>

        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Tenaga Kependidikan'
        ])


<div class="container py-5">  
  <div class="container-guru">
    @foreach ($staff as $staff)
      <div class="card-guru">
            <img src="{{ asset('storage/' . $staff->foto) }}" alt="Foto staff">
            <div class="card-body-guru">
                <div class="name">{{ $staff->nama }}</div>
            </div>
        </div>
    @endforeach
    </div>
</div>

    </div>
@endsection
