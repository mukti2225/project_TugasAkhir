@extends('layouts.app', [
    'title' => 'Lihat Pengumuman',
])

@section('content')
<div class="container show">

    <div class="headline mb-2">
        <h3>{{ $pengumuman->judul }}</h3>
    </div>


    <span class="text-muted d-block mb-3 d-flex justify-content-between align-items-center">
        {{ $pengumuman->created_at->format('F, d Y') }}
        @if($pengumuman->file_pdf)
            <a href="{{ asset('storage/' . $pengumuman->file_pdf) }}" class="btn btn-sm btn-success ms-2 rounded-circle d-inline-flex align-items-center justify-content-center" style="width:36px;height:36px;padding:0;" download title="Download PDF">
                <i class="bi bi-download"></i>
            </a>
        @endif
    </span>

    <div
        class="blog-img d-flex align-items-center justify-content-center mb-4"
        style="background-image: url('{{ asset('img/logo/announcement.png') }}')">
    </div>

</div>
@endsection