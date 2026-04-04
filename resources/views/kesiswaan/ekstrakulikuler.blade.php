@extends('layouts.app',[
    'title' => 'Ekstrakulikuler',
])

@section('content')
    <!-- Header -->
    @include('components.page-header', [
        'title' => 'Ekstrakulikuler'
    ])

    <div class="container py-5">
        <div class="ekstrakulikuler">
            <div class="grid">
                @foreach($ekstrakulikuler as $item)
                <div class="card">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                    <div class="overlay">
                        <h3>{{ $item->nama }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
.container .ekstrakulikuler {
    max-width: 1200px;
    margin: 0 auto;
    padding: 10px 20px;
}

.ekstrakulikuler .grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 10px;
    margin-top: 10px;
}

.ekstrakulikuler .card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    background: #fff;
    height: 300px;
}

.ekstrakulikuler .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

/* Gambar pada card */
.ekstrakulikuler .card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.ekstrakulikuler .card:hover img {
    transform: scale(1.1);
}

/* Overlay untuk teks */
.ekstrakulikuler .overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0));
    color: white;
    padding: 40px 20px 20px;
    transform: translateY(0);
    transition: all 0.3s ease;
}

.ekstrakulikuler .card:hover .overlay {
    padding-bottom: 30px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0));
}

/* Judul ekstrakulikuler */
.ekstrakulikuler .overlay h3 {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    transform: translateY(0);
    transition: transform 0.3s ease;
}

.ekstrakulikuler .card:hover .overlay h3 {
    transform: translateY(-5px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .ekstrakulikuler .grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
    
    .ekstrakulikuler .card {
        height: 260px;
    }
    
    .ekstrakulikuler .overlay h3 {
        font-size: 1.2rem;
    }
    
    .container {
        padding: 20px 15px;
    }
}

@media (max-width: 480px) {
    .ekstrakulikuler .grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .ekstrakulikuler .card {
        height: 240px;
    }
    
    .ekstrakulikuler .overlay h3 {
        font-size: 1.1rem;
    }
}

/* Animasi fade in untuk card */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.ekstrakulikuler .card {
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
}

/* Efek loading shimmer untuk gambar (opsional) */
.ekstrakulikuler .card img {
    background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
    background-size: 200% 100%;
    animation: shimmer 1.5s linear infinite;
}

@keyframes shimmer {
    to {
        background-position: -200% 0;
    }
}

/* Setelah gambar selesai loading, hapus efek shimmer */
.ekstrakulikuler .card img[loading="lazy"] {
    animation: none;
}
</style>
@endpush