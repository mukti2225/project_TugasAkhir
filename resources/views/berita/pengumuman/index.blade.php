@extends('layouts.app',[
    'title' => 'List Pengumuman',
])

@section('content')
<section class="section-padding-100-0 mb-50">
    <div class="container">
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Pengumuman'
        ])
    </div>
</section>
@endsection