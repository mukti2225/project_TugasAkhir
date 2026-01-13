    <div class="hero-area container-fluid">
        <div class="hero-wrapper">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="bg-img bg-overlay-2by5 d-flex align-items-center"
                                 style="background-image:url('{{ asset('storage/'.$slider->image) }}')">
                                <div class="container text-white">
                                    <p class="text-warning mb-2">{{ $slider->kategori }}</p>

                                    <h2 class="fw-bold mb-3">
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

                <button class="carousel-control-prev" type="button"
                        data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button"
                        data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>

        </div>

    </div>