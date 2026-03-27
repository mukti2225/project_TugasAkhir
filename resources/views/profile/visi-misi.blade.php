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
        <div class="container py-5">
            <div class="row align-items-center">
                <!-- kiri -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <h3 class="fw-bold text-center">Visi</h3>

                    <p style="text-align: justify;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ut mauris sed ipsum 
                        consequat tempor. Maecenas magna orci, dictum eu nisl isl, ornare dignissim ligula. 
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis 
                        feugiat vitae odio. Fusce sed elementum nunc. Nunc sagittis porta gravida. Aliquam erat 
                        volutpat. Phasellus dignissim ultricies purus eu ullamcorper. Phasellus sit amet turpis 
                        vehicula, porttitor est eget, dictum ligula. Mauris tempor aliquet ut urna posuere, vitae 
                        posuere nibh ultrices. Aliquam tempus augue non ante imperdiet, sit amet facilisis nisl 
                        posuere. Ut id odio vitae nulla convallis. Aliquam massa odio, dictum vel suscipit 
                        non, molestie ac libero. Mauris in justo quis elit hendrerit sodales eu vel augue. Donec ut 
                        maximus erat. Nulla auctor ornare nisl, vitae finibus arcu consectetur semper.
                    </p>
                </div>

                <!-- kanan -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <h3 class="fw-bold text-center">Misi</h3>

                    <p style="text-align: justify;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ut mauris sed ipsum 
                        consequat tempor. Maecenas magna orci, dictum eu nisl isl, ornare dignissim ligula. 
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis 
                        feugiat vitae odio. Fusce sed elementum nunc. Nunc sagittis porta gravida. Aliquam erat 
                        volutpat. Phasellus dignissim ultricies purus eu ullamcorper. Phasellus sit amet turpis 
                        vehicula, porttitor est eget, dictum ligula. Mauris tempor aliquet ut urna posuere, vitae 
                        posuere nibh ultrices. Aliquam tempus augue non ante imperdiet, sit amet facilisis nisl 
                        posuere. Ut id odio vitae nulla convallis. Aliquam massa odio, dictum vel suscipit 
                        non, molestie ac libero. Mauris in justo quis elit hendrerit sodales eu vel augue. Donec ut 
                        maximus erat. Nulla auctor ornare nisl, vitae finibus arcu consectetur semper.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
