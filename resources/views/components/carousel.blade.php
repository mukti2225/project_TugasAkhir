    <div class="hero-area">
        <div class="hero-wrapper">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-indicators">
                    @foreach($sliders as $key => $slider)
                        <button type="button"
                                data-bs-target="#heroCarousel" 
                                data-bs-slide-to="{{ $key }}"
                                class="{{ $key == 0 ? 'active' : '' }}" 
                                aria-current="{{ $key == 0 ? 'true' : 'false' }}" 
                                aria-label="Slide {{ $key + 1 }}">
                        </button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="bg-img bg-overlay-2by5 d-flex align-items-center"
                                 style="background-image:url('{{ asset('storage/'.$slider->image) }}')">
                                <div class="container text-hero">
                                    <p class="text-warning mb-2">{{ $slider->kategori }}</p>

                                    <h2 class="fw-bold mb-2">
                                        {{ $slider->title }}
                                    </h2>

                                    @if($slider->subtitle)
                                        <p class="mb-4">
                                            {{ $slider->subtitle }}
                                        </p>
                                    @endif

                                    @if($slider->button_text)
                                        <a href="{{ $slider->button_link }}"
                                           class="btn btn-primary me-2">
                                            {{ $slider->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>