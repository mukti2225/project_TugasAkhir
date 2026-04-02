@extends('layouts.app', [
    'title' => 'Visi Misi',
])

@section('content')
    <div>

        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Visi Misi'
        ])

        
        <!-- Content -->
        <div class="container visi-misi">
            <div class="row align-items-center">
                @if($visiMisi)
                <!-- kiri -->
                <div class="col-md-7 mb-4 mb-md-0">
                    <div class="visi">
                        <h3 class="fw-bold text-center">Visi</h3>

                        <p style="text-align: justify;">
                        {!! $visiMisi->visi !!}
                        </p>
                    </div>
                    
                    <div class="misi">
                        <h3 class="fw-bold text-center">Misi</h3>

                        <div style="text-align: justify;">
                            {!! $visiMisi->misi !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mb-4 mb-md-0">
                    <img src="img/dump/visi-misi.png" class="img-fluid rounded">
                </div>
                @else

                <div class="col-12 text-center">
                    <h3 class="fw-bold">Visi dan Misi belum tersedia</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
