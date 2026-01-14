@extends('layouts.app',[
    'title' => 'List Artikel',
])

@section('content')
<section class="blog-area section-padding-100-0 mb-50">
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-6">
                <div class="section-heading">
                    <h3>List Artikel</h3>
                </div>
            </div>
            <div class="col-6">
                <form class="d-flex me-3" action="{{ route('artikel.search') }}" method="GET">
                <input class="form-control form-control-sm me-2" type="search"
                       name="keyword" placeholder="Search">
                <button class="btn btn-outline-primary btn-sm" type="submit">Search
                </button>
                </form> 
            </div>
        </div>

        <div class="row">
            
            @foreach($artikel as $art)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            {{ $art->judul }}
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $art->thumbnail) }}" width="100%" style="height: 300px; object-fit: cover; object-position: center;">

                            <div class="card-text mt-3">
                                {!! Str::limit($art->deskripsi) !!}
                            </div>

                            <a href="{{ route('artikel.show', ['artikel' => $art->slug]) }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg pagination pagination-center justify-content-center">
                {{ $artikel->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</section>
@endsection