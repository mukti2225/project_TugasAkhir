@if ($gallery->count() > 0)
    <section class="section-gallery py-4">
        <div class="container">
            {{-- Header --}}
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <span class="section-label">Gallery Sekolah</span>
                    <div class="section-divider mx-auto mt-2 mb-3"></div>
                    <h2 class="section-title">Dokumentasi Kegiatan Sekolah</h2>
                    <p class="section-desc mx-auto">
                        Jelajahi berbagai aktivitas, momen, dan prestasi yang terjadi di lingkungan sekolah kami.
                    </p>
                </div>
            </div>

            <div class="col-12 mb-6 mb-lg-3 justify-content-center d-flex">
                <div class="scroll" id="galleryContainer">
                    @foreach ($gallery as $item)
                        <div class="item" data-aos="zoom-in">
                            <div class="card-gallery rounded-3 shadow-sm position-relative overflow-hidden"
                                data-img="{{ asset('storage/' . $item->image) }}" data-title="{{ $item->title }}"
                                role="button" tabindex="0">
                                <!-- Overlay Hover -->
                                <div
                                    class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end align-items-center text-center p-4">
                                    <span class="text-overlay">{{ $item->title }}</span>
                                </div>
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    class="img w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                                    loading="lazy">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('profil.galeri-sekolah') }}" class="btn-lihat-semua">
                    Lihat Semua Galeri &rarr;
                </a>
            </div>
        </div>
    </section>

    {{-- ===== MODAL GALLERY ===== --}}
    <div id="galleryModal" class="gm-overlay" role="dialog" aria-modal="true" aria-label="Tampilan Foto"
        aria-hidden="true">
        <div class="gm-backdrop"></div>
        <div class="gm-dialog">

            {{-- Close --}}
            <button class="gm-close" id="gmClose" aria-label="Tutup modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </button>

            {{-- Prev --}}
            <button class="gm-nav gm-prev" id="gmPrev" aria-label="Foto sebelumnya">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 16 16">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 16 16">
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

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const galleryContainer = document.getElementById('galleryContainer');
                if (!galleryContainer) return;

                // ─────────────────────────────────────────
                // CONFIG
                // ─────────────────────────────────────────
                const isMobile = window.innerWidth <= 768;
                const originalItems = Array.from(
                    galleryContainer.querySelectorAll('.item')
                );

                // ─────────────────────────────────────────
                // INFINITE SCROLL (DESKTOP ONLY)
                // ─────────────────────────────────────────
                if (!isMobile) {
                    originalItems.forEach(item => {
                        const clone = item.cloneNode(true);
                        clone.setAttribute('aria-hidden', 'true');
                        galleryContainer.appendChild(clone);
                    });
                }

                // ─────────────────────────────────────────
                // GET ORIGINAL WIDTH
                // ─────────────────────────────────────────
                function getOriginalWidth() {
                    return originalItems.reduce((acc, el) => {
                        const style = getComputedStyle(el);
                        return (
                            acc +
                            el.offsetWidth +
                            parseFloat(style.marginLeft) +
                            parseFloat(style.marginRight)
                        );
                    }, 0);
                }

                // ─────────────────────────────────────────
                // INFINITE RESET
                // ─────────────────────────────────────────
                function clampScroll() {
                    if (isMobile) return;
                    const ow = getOriginalWidth();
                    if (galleryContainer.scrollLeft >= ow) {
                        galleryContainer.scrollLeft -= ow;
                    } else if (galleryContainer.scrollLeft <= 0) {
                        galleryContainer.scrollLeft += ow;
                    }
                }

                if (!isMobile) {
                    galleryContainer.addEventListener('scroll', clampScroll, {
                        passive: true
                    });

                    // Mulai dari tengah
                    galleryContainer.scrollLeft = getOriginalWidth() / 2;
                }

                // ─────────────────────────────────────────
                // DRAG DESKTOP
                // ─────────────────────────────────────────
                let isDown = false;
                let isDragging = false;

                let startX;
                let scrollLeft;

                if (!isMobile) {
                    galleryContainer.addEventListener('mousedown', (e) => {
                        isDown = true;
                        isDragging = false;
                        startX = e.pageX - galleryContainer.offsetLeft;
                        scrollLeft = galleryContainer.scrollLeft;
                        galleryContainer.style.cursor = 'grabbing';
                    });

                    galleryContainer.addEventListener('mouseleave', () => {
                        isDown = false;
                        galleryContainer.style.cursor = 'grab';
                    });

                    galleryContainer.addEventListener('mouseup', () => {
                        isDown = false;
                        galleryContainer.style.cursor = 'grab';
                        setTimeout(() => {
                            isDragging = false;
                        }, 50);
                    });

                    galleryContainer.addEventListener('mousemove', (e) => {
                        if (!isDown) return;
                        isDragging = true;
                        e.preventDefault();
                        const x = e.pageX - galleryContainer.offsetLeft;
                        const walk = (x - startX) * 1.5;
                        galleryContainer.scrollLeft = scrollLeft - walk;
                    });
                }

                // ─────────────────────────────────────────
                // HOVER EFFECT
                // ─────────────────────────────────────────
                galleryContainer.addEventListener('mouseover', (e) => {
                    const card = e.target.closest('.card-gallery');
                    if (card) {
                        card.classList.add('active');
                    }
                });
                galleryContainer.addEventListener('mouseout', (e) => {
                    const card = e.target.closest('.card-gallery');
                    if (card) {
                        card.classList.remove('active');
                    }
                });

                // ─────────────────────────────────────────
                // MODAL
                // ─────────────────────────────────────────
                const modal = document.getElementById('galleryModal');
                const gmImage = document.getElementById('gmImage');
                const gmTitle = document.getElementById('gmTitle');
                const gmCounter = document.getElementById('gmCounter');
                const gmLoader = document.getElementById('gmLoader');
                const gmClose = document.getElementById('gmClose');
                const gmPrev = document.getElementById('gmPrev');
                const gmNext = document.getElementById('gmNext');
                const backdrop = modal.querySelector('.gm-backdrop');

                // ─────────────────────────────────────────
                // ITEMS DATA
                // ─────────────────────────────────────────
                const items = originalItems.map(el => {
                    const card = el.querySelector('.card-gallery');
                    return {
                        src: card.dataset.img,
                        title: card.dataset.title
                    };
                });
                let currentIndex = 0;

                // ─────────────────────────────────────────
                // SHOW MODAL
                // ─────────────────────────────────────────
                function showModal(index) {
                    currentIndex = index;
                    modal.setAttribute('aria-hidden', 'false');
                    modal.classList.add('gm-open');
                    document.body.style.overflow = 'hidden';
                    loadImage(index);
                }

                // ─────────────────────────────────────────
                // CLOSE MODAL
                // ─────────────────────────────────────────
                function closeModal() {
                    modal.classList.remove('gm-open');
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                    gmImage.src = '';
                }

                // ─────────────────────────────────────────
                // LOAD IMAGE
                // ─────────────────────────────────────────
                function loadImage(index) {
                    const item = items[index];
                    gmImage.classList.add('gm-loading');
                    gmLoader.classList.add('gm-show');
                    gmTitle.textContent = item.title;
                    gmCounter.textContent =
                        `${index + 1} / ${items.length}`;
                    const tempImg = new Image();
                    tempImg.onload = () => {
                        gmImage.src = item.src;
                        gmImage.alt = item.title;
                        gmImage.classList.remove('gm-loading');
                        gmLoader.classList.remove('gm-show');
                    };
                    tempImg.src = item.src;
                    gmPrev.style.display =
                        items.length > 1 ? 'flex' : 'none';
                    gmNext.style.display =
                        items.length > 1 ? 'flex' : 'none';
                }

                // ─────────────────────────────────────────
                // NAVIGATION
                // ─────────────────────────────────────────
                function prev() {
                    currentIndex =
                        (currentIndex - 1 + items.length) % items.length;
                    loadImage(currentIndex);
                }

                function next() {
                    currentIndex =
                        (currentIndex + 1) % items.length;
                    loadImage(currentIndex);
                }

                // ─────────────────────────────────────────
                // OPEN MODAL
                // ─────────────────────────────────────────
                galleryContainer.addEventListener('click', (e) => {
                    const card = e.target.closest('.card-gallery');
                    if (!card) return;

                    // Desktop: cegah modal saat drag
                    if (!isMobile && isDragging) {
                        isDragging = false;
                        return;
                    }
                    const allCards = galleryContainer.querySelectorAll(
                        '.item:not([aria-hidden]) .card-gallery'
                    );
                    const index =
                        Array.from(allCards).indexOf(card);
                    if (index !== -1) {
                        showModal(index);
                    }
                });

                // ─────────────────────────────────────────
                // KEYBOARD ACCESSIBILITY
                // ─────────────────────────────────────────
                galleryContainer.addEventListener('keydown', (e) => {
                    if (e.key !== 'Enter' && e.key !== ' ') return;
                    const card = e.target.closest('.card-gallery');
                    if (!card) return;
                    e.preventDefault();
                    const allCards = galleryContainer.querySelectorAll(
                        '.item:not([aria-hidden]) .card-gallery'
                    );
                    const index =
                        Array.from(allCards).indexOf(card);
                    if (index !== -1) {
                        showModal(index);
                    }
                });

                // ─────────────────────────────────────────
                // BUTTON EVENTS
                // ─────────────────────────────────────────
                gmClose.addEventListener('click', closeModal);
                backdrop.addEventListener('click', closeModal);
                gmPrev.addEventListener('click', prev);
                gmNext.addEventListener('click', next);

                // ─────────────────────────────────────────
                // KEYBOARD NAVIGATION
                // ─────────────────────────────────────────
                document.addEventListener('keydown', (e) => {
                    if (!modal.classList.contains('gm-open')) return;
                    if (e.key === 'Escape') {
                        closeModal();
                    }
                    if (e.key === 'ArrowLeft') {
                        prev();
                    }
                    if (e.key === 'ArrowRight') {
                        next();
                    }
                });

                // ─────────────────────────────────────────
                // MOBILE SWIPE MODAL
                // ─────────────────────────────────────────
                let touchModalStartX = 0;
                modal.addEventListener('touchstart', (e) => {
                    touchModalStartX =
                        e.touches[0].clientX;
                }, {
                    passive: true
                });
                modal.addEventListener('touchend', (e) => {
                    const diff =
                        touchModalStartX -
                        e.changedTouches[0].clientX;
                    if (Math.abs(diff) > 50) {
                        diff > 0 ? next() : prev();
                    }
                });
            });
        </script>
    @endpush
@endif
