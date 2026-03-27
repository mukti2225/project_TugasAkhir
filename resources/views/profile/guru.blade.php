@extends('layouts.app', [
    'title' => 'Tenaga Pengajar',
])

@section('content')
    <div>
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Tenaga Pengajar'
        ])

        <div class="col-lg-12 mb-6 mb-lg-0">
        <div class="gallery-scroll justify-content-center">
          <div class="gallery-item">
            <div class="card-gallery">
                <img src="{{ asset() }}" alt="Gallery Image">
            </div>
          </div>
        </div>
      </div>

    </div>
@endsection
