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

      <div class="card-guru">
            <img src="{{ asset('img/dump/dosen.jpg') }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">LUSI TRIANA, S.Pd., MM</div>
            </div>
        </div>


        <div class="card-guru">
            <img src="{{ asset('img/dump/dosen.jpg') }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">JULIANTI, S.Pd.</div>
            </div>
        </div>


        <div class="card-guru">
            <img src="{{ asset('img/dump/dosen.jpg') }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">YULIA ROSSA, S.Pd., M.M.Pd.</div>
            </div>
        </div>


        <div class="card-guru">
            <img src="{{ asset('img/dump/dosen.jpg') }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">SUMINAR BUDIONO, S.T.</div>
            </div>
        </div>


        <div class="card-guru">
            <img src="{{ asset('img/dump/dosen.jpg') }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">RIRIS LINTANGRIA BB, S.Pd.</div>
            </div>
        </div>


        <div class="card-guru">
            <img src="{{ asset('img/dump/dosen.jpg') }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">GANIK SITI MURTIJAH, S.Pd.</div>
            </div>
        </div>


        <div class="card-guru">
            <img src="{{ asset('img/dump/dosen.jpg') }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">ENDEN NURSIPAH, S.Pd.</div>
            </div>
        </div>


        <div class="card-guru">
            <img src="{{ asset('img/dump/dosen.jpg') }}" alt="Foto Guru">
            <div class="card-body-guru">
                <div class="name">MARGONO, S.Pd., MM</div>
            </div>
        </div>
    </div>
</div>

    </div>
@endsection
