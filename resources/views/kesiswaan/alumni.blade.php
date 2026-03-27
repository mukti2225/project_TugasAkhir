@extends('layouts.app',[
    'title' => 'Alumni',
])

@section('content')
    <!-- Header -->
        @include('components.page-header', [
            'title' => 'Alumni'
        ])
@endsection