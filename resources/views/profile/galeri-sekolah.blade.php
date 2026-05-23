@extends('layouts.app', [
    'title' => 'Galeri - ',
])

@section('content')
    <div>
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Galeri Sekolah',
        ])

        <div class="galeri">
            @if ($galeri->count())
                <div class="galeri_grid">
                    @foreach ($galeri as $item)
                        <div class="galeri_item card-gallery" data-img="{{ asset('storage/' . $item->image) }}"
                            data-title="{{ $item->title }}" tabindex="0">

                            <div class="galeri_item-photo">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">

                                <div class="galeri_item-overlay">
                                    <span class="galeri_item-icon">
                                        <i class="bi bi-search"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="galeri_item-body">
                                <div class="galeri_item-title">
                                    {{ $item->title }}
                                </div>
                            </div>
                        </div>

                        {{-- ===== MODAL GALLERY ===== --}}
                        <div id="galleryModal" class="gm-overlay" role="dialog" aria-modal="true"
                            aria-label="Tampilan Foto" aria-hidden="true">
                            <div class="gm-backdrop"></div>
                            <div class="gm-dialog">

                                {{-- Close --}}
                                <button class="gm-close" id="gmClose" aria-label="Tutup modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button>

                                {{-- Prev --}}
                                <button class="gm-nav gm-prev" id="gmPrev" aria-label="Foto sebelumnya">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </button>

                                {{-- Image --}}
                                <div class="gm-img-wrapper">
                                    <div class="gm-loader" id="gmLoader"></div>
                                    <img id="gmImage" src="" class="gm-image">
                                </div>

                                {{-- Next --}}
                                <button class="gm-nav gm-next" id="gmNext" aria-label="Foto berikutnya">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button>

                                {{-- Caption --}}
                                <div class="gm-caption">
                                    <span id="gmTitle"></span>
                                    <span id="gmCounter" class="gm-counter"></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-3">
                    <h4 class="fw-bold">Galeri Sekolah belum tersedia</h4>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const modal = document.getElementById('galleryModal');
            const gmImage = document.getElementById('gmImage');
            const gmTitle = document.getElementById('gmTitle');
            const gmCounter = document.getElementById('gmCounter');
            const gmLoader = document.getElementById('gmLoader');

            const gmClose = document.getElementById('gmClose');
            const gmPrev = document.getElementById('gmPrev');
            const gmNext = document.getElementById('gmNext');

            const backdrop = modal.querySelector('.gm-backdrop');

            const galleryItems = document.querySelectorAll('.card-gallery');

            const items = Array.from(galleryItems).map(item => ({
                src: item.dataset.img,
                title: item.dataset.title
            }));

            let currentIndex = 0;

            function openModal(index) {
                currentIndex = index;

                modal.classList.add('gm-open');
                modal.setAttribute('aria-hidden', 'false');

                document.body.style.overflow = 'hidden';

                loadImage(index);
            }

            function closeModal() {
                modal.classList.remove('gm-open');
                modal.setAttribute('aria-hidden', 'true');

                document.body.style.overflow = '';

                gmImage.src = '';
            }

            function loadImage(index) {

                const item = items[index];

                gmLoader.classList.add('gm-show');

                gmTitle.textContent = item.title;
                gmCounter.textContent = `${index + 1} / ${items.length}`;

                const img = new Image();

                img.onload = function() {
                    gmImage.src = item.src;
                    gmImage.alt = item.title;

                    gmLoader.classList.remove('gm-show');
                };

                img.src = item.src;
            }

            function nextImage() {
                currentIndex = (currentIndex + 1) % items.length;
                loadImage(currentIndex);
            }

            function prevImage() {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                loadImage(currentIndex);
            }

            galleryItems.forEach((item, index) => {

                item.addEventListener('click', function() {
                    openModal(index);
                });

                item.addEventListener('keydown', function(e) {

                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        openModal(index);
                    }
                });
            });

            gmClose.addEventListener('click', closeModal);

            backdrop.addEventListener('click', closeModal);

            gmNext.addEventListener('click', nextImage);

            gmPrev.addEventListener('click', prevImage);

            document.addEventListener('keydown', function(e) {

                if (!modal.classList.contains('gm-open')) return;

                if (e.key === 'Escape') {
                    closeModal();
                }

                if (e.key === 'ArrowRight') {
                    nextImage();
                }

                if (e.key === 'ArrowLeft') {
                    prevImage();
                }
            });

            // Swipe mobile
            let touchStartX = 0;

            modal.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            modal.addEventListener('touchend', function(e) {

                const touchEndX = e.changedTouches[0].screenX;

                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > 50) {

                    if (diff > 0) {
                        nextImage();
                    } else {
                        prevImage();
                    }
                }
            });

        });
    </script>
@endpush
