<section class="agenda-section">
    <div class="container">

        {{-- Header --}}
        <div class="agenda-header">
            <div>
                <p class="agenda-eyebrow">Kalender Kegiatan</p>
                <h2 class="agenda-title">Agenda Sekolah</h2>
            </div>
        </div>

        {{-- Layout --}}
        <div class="agenda-wrap">
            {{-- Kalender --}}
            <div class="agenda-cal-card" data-aos="fade-right" data-aos-duration="500">
                <div class="cal-nav">
                    <button class="cal-nav-btn" id="agPrevBtn">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <span class="cal-month-label" id="agCalMonth"></span>
                    <button class="cal-nav-btn" id="agNextBtn">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
                <div class="cal-grid" id="agCalGrid"></div>

                {{-- Legend --}}
                <div class="cal-legend">
                    <div class="cal-legend-item">
                        <span class="cal-legend-dot dot-upacara"></span>
                        Upacara
                    </div>

                    <div class="cal-legend-item">
                        <span class="cal-legend-dot dot-akademik"></span>
                        Akademik
                    </div>

                    <div class="cal-legend-item">
                        <span class="cal-legend-dot dot-olahraga"></span>
                        Olahraga
                    </div>

                    <div class="cal-legend-item">
                        <span class="cal-legend-dot dot-kegiatan"></span>
                        Kegiatan
                    </div>

                    <div class="cal-legend-item">
                        <span class="cal-legend-dot dot-libur"></span>
                        Libur
                    </div>
                </div>

            </div>
            {{-- Detail --}}
            <div class="agenda-detail" data-aos="flip-up" data-aos-duration="600">
                <p class="agenda-detail-label" id="agDetailLabel">
                    Agenda bulan ini
                </p>

                <div class="agenda-detail-list" id="agDetailList"></div>
            </div>
        </div>
    </div>
</section>

@php
    $agendaJson = $agendas->map(function ($item) {
        return [
            'date' => \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d'),
            'judul' => $item->judul,
            'kat' => $item->kategori,
            'jam' => $item->jam,
            'lokasi' => $item->lokasi,
            'deskripsi' => $item->deskripsi,
        ];
    });
@endphp

@push('js')
    <script>
        (function() {
            const CURRENT_YEAR = new Date().getFullYear();
            const AGENDA = @json($agendaJson);

            /* =====================================================
               KONSTANTA
            ===================================================== */

            const MONTHS = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];

            const DAYS = [
                'Min',
                'Sen',
                'Sel',
                'Rab',
                'Kam',
                'Jum',
                'Sab'
            ];

            const LABEL = {
                upacara: 'Upacara',
                akademik: 'Akademik',
                olahraga: 'Olahraga',
                kegiatan: 'Kegiatan',
                libur: 'Libur'
            };

            const today = new Date();
            let viewYear = today.getFullYear();
            let viewMonth = today.getMonth();
            let selected = null;

            /* =====================================================
               HELPERS
            ===================================================== */
            function pad(n) {
                return String(n).padStart(2, '0');
            }

            function isoDate(y, m, d) {
                return `${y}-${pad(m + 1)}-${pad(d)}`;
            }

            function byDate(iso) {
                return AGENDA.filter(a => a.date === iso);
            }

            function byMonth(y, m) {
                return AGENDA.filter(a =>
                    a.date.startsWith(`${y}-${pad(m + 1)}`)
                );
            }

            /* =====================================================
               RENDER KALENDER
            ===================================================== */
            function renderCal() {
                const grid = document.getElementById('agCalGrid');
                const label = document.getElementById('agCalMonth');
                label.textContent = `${MONTHS[viewMonth]} ${viewYear}`;
                grid.innerHTML = '';
                /* Header Hari */
                DAYS.forEach(day => {
                    const el = document.createElement('div');
                    el.className = 'cal-dow';
                    el.textContent = day;
                    grid.appendChild(el);
                });
                const firstDay = new Date(viewYear, viewMonth, 1).getDay();
                const totalDays = new Date(
                    viewYear,
                    viewMonth + 1,
                    0
                ).getDate();

                const prevTotal = new Date(
                    viewYear,
                    viewMonth,
                    0
                ).getDate();

                /* Tanggal Bulan Sebelumnya */
                for (let i = 0; i < firstDay; i++) {
                    const el = document.createElement('div');
                    el.className = 'cal-cell cal-other';
                    el.innerHTML = `
                <span class="cal-num">
                    ${prevTotal - firstDay + 1 + i}
                </span>
            `;
                    grid.appendChild(el);
                }

                /* Tanggal Bulan Aktif */
                for (let d = 1; d <= totalDays; d++) {
                    const iso = isoDate(viewYear, viewMonth, d);
                    const evs = byDate(iso);
                    const isToday =
                        viewYear === today.getFullYear() &&
                        viewMonth === today.getMonth() &&
                        d === today.getDate();
                    const isSelected = selected === iso;
                    const el = document.createElement('div');
                    let cls = 'cal-cell';
                    if (isToday) cls += ' cal-today';
                    if (isSelected && !isToday) {
                        cls += ' cal-selected';
                    }
                    if (evs.length) {
                        cls += ' cal-has-event';
                    }
                    el.className = cls;
                    /* FIX TAMPILAN ANGKA */
                    el.innerHTML = `
                <span class="cal-num">${d}</span>
            `;

                    /* DOT EVENT */
                    if (evs.length) {
                        const dw = document.createElement('div');
                        dw.className = 'cal-dots';
                        evs.slice(0, 3).forEach(ev => {
                            const dot = document.createElement('span');
                            dot.className = `cal-dot dot-${ev.kat}`;
                            dw.appendChild(dot);
                        });
                        el.appendChild(dw);
                        el.addEventListener('click', function() {
                            selected = iso;
                            renderCal();
                            renderDetail(iso);
                        });
                    }

                    grid.appendChild(el);
                }

                /* Sisa Grid */
                const remainder = (firstDay + totalDays) % 7;
                if (remainder) {
                    for (let d = 1; d <= 7 - remainder; d++) {
                        const el = document.createElement('div');
                        el.className = 'cal-cell cal-other';
                        el.innerHTML = `
                    <span class="cal-num">${d}</span>
                `;

                        grid.appendChild(el);
                    }
                }
            }

            /* =====================================================
               RENDER DETAIL
            ===================================================== */

            function renderDetail(iso) {
                const list = document.getElementById('agDetailList');
                const lbl = document.getElementById('agDetailLabel');
                const evs = iso ?
                    byDate(iso) :
                    byMonth(viewYear, viewMonth);
                if (iso) {
                    const d = new Date(iso + 'T00:00:00');
                    lbl.textContent =
                        `${d.getDate()} ${MONTHS[d.getMonth()]} ${d.getFullYear()}`;
                } else {
                    lbl.textContent =
                        `Agenda ${MONTHS[viewMonth]} ${viewYear}`;
                }

                if (!evs.length) {
                    list.innerHTML = `
                <div class="agenda-empty">
                    <i class="bi bi-calendar-x"></i>
                    <p>
                        ${iso
                            ? 'Tidak ada agenda di tanggal ini'
                            : 'Belum ada agenda bulan ini'}
                    </p>
                </div>
            `;

                    return;
                }
                list.innerHTML = evs.map(ev => `
                <div class="ev-card">
                    <div class="ev-strip ${ev.kat}"></div>
                    <div class="ev-body">
                        <p class="ev-title">
                            ${ev.judul}
                        </p>
                        <div class="ev-meta">

                            ${ev.jam
                                ? `<span class="ev-meta-item">
                                                        <i class="bi bi-clock"></i>
                                                        ${ev.jam}
                                                    </span>`
                                : ''
                            }

                            ${ev.lokasi
                                ? `<span class="ev-meta-item">
                                                        <i class="bi bi-geo-alt"></i>
                                                        ${ev.lokasi}
                                                    </span>`
                                : ''
                            }

                        </div>

                        ${ev.deskripsi
                            ? `<p class="ev-desc">
                                                    <i class="bi bi-text-left me-1"></i>
                                                    ${ev.deskripsi}
                                            </p>`
                            : ''
                        }

                    </div>
                    <span class="ev-badge ev-badge-${ev.kat}">
                        ${LABEL[ev.kat] ?? ev.kat}
                    </span>
                </div>
            `).join('');
            }

            /* =====================================================
               NAVIGASI
            ===================================================== */

            document
                .getElementById('agPrevBtn')
                .addEventListener('click', function() {
                    viewMonth--;
                    if (viewMonth < 0) {
                        viewMonth = 11;
                        viewYear--;
                    }
                    selected = null;
                    renderCal();
                    renderDetail(null);
                });

            document
                .getElementById('agNextBtn')
                .addEventListener('click', function() {
                    viewMonth++;
                    if (viewMonth > 11) {
                        viewMonth = 0;
                        viewYear++;
                    }

                    selected = null;
                    renderCal();
                    renderDetail(null);
                });

            /* =====================================================
               INIT
            ===================================================== */

            renderCal();
            renderDetail(null);

        })();
    </script>
@endpush
