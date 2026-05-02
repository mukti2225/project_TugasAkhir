@extends('layouts.app',[
    'title' => 'Kontak',
])

@section('content')
    <section class="ks-section">
    <div class="ks-container">
 
        {{-- ===== FORM KRITIK & SARAN ===== --}}
        <div class="ks-card">
            <div class="ks-card-header">
                <span class="ks-icon">✉️</span>
                <h2 class="ks-title">Form Kritik & Saran</h2>
            </div>
 
            {{-- <form action="{{ route('kritik-saran.store') }}" method="POST" class="ks-form"> --}}
                @csrf
 
                <div class="ks-form-group">
                    <label for="nama" class="ks-label">
                        Nama Lengkap <span class="ks-required">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="ks-input @error('nama') ks-input-error @enderror"
                        value="{{ old('nama') }}"
                        placeholder=""
                        required
                    >
                    @error('nama')
                        <span class="ks-error-msg">{{ $message }}</span>
                    @enderror
                </div>
 
                <div class="ks-form-group">
                    <label for="email" class="ks-label">
                        Email <span class="ks-required">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="ks-input @error('email') ks-input-error @enderror"
                        value="{{ old('email') }}"
                        placeholder=""
                        required
                    >
                    @error('email')
                        <span class="ks-error-msg">{{ $message }}</span>
                    @enderror
                </div>
 
                <div class="ks-form-group">
                    <label for="subjek" class="ks-label">
                        Subjek <span class="ks-required">*</span>
                    </label>
                    <div class="ks-select-wrapper">
                        <select
                            id="subjek"
                            name="subjek"
                            class="ks-select @error('subjek') ks-input-error @enderror"
                            required
                        >
                            <option value="" disabled {{ old('subjek') ? '' : 'selected' }}>Pilih subjek pesan</option>
                            <option value="kritik"    {{ old('subjek') == 'kritik'    ? 'selected' : '' }}>Kritik</option>
                            <option value="saran"     {{ old('subjek') == 'saran'     ? 'selected' : '' }}>Saran</option>
                            <option value="pertanyaan"{{ old('subjek') == 'pertanyaan'? 'selected' : '' }}>Pertanyaan</option>
                            <option value="lainnya"   {{ old('subjek') == 'lainnya'   ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <span class="ks-select-arrow">&#8964;</span>
                    </div>
                    @error('subjek')
                        <span class="ks-error-msg">{{ $message }}</span>
                    @enderror
                </div>
 
                <div class="ks-form-group">
                    <label for="pesan" class="ks-label">
                        Pesan <span class="ks-required">*</span>
                    </label>
                    <textarea
                        id="pesan"
                        name="pesan"
                        class="ks-textarea @error('pesan') ks-input-error @enderror"
                        rows="5"
                        required
                    >{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <span class="ks-error-msg">{{ $message }}</span>
                    @enderror
                </div>
 
                <button type="submit" class="ks-btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:6px;vertical-align:-2px">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54L13.026 8.03A4.5 4.5 0 0 1 8 12.5c-1.8 0-3.4-.99-4.21-2.44L.147 15.854a.5.5 0 0 1-.708-.708L4.5 10.083A4.476 4.476 0 0 1 3.5 8a4.5 4.5 0 0 1 4.5-4.5c.83 0 1.607.225 2.275.618L15.314.036a.5.5 0 0 1 .54.11z"/>
                    </svg>
                    Kirim Pesan
                </button>
 
                @if(session('success'))
                    <div class="ks-alert-success">{{ session('success') }}</div>
                @endif
            </form>
        </div>
 
        {{-- ===== LOKASI SEKOLAH ===== --}}
        <div class="ks-card">
            <div class="ks-card-header">
                <span class="ks-icon">🗺️</span>
                <h2 class="ks-title">Lokasi Sekolah</h2>
            </div>
 
            <div class="ks-map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.896544855794!2d106.69405587442618!3d-6.277330661446714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69faec7eaef2ad%3A0x840521afb64d5ebf!2sHigh%20School%20Arif%20Rahman%20Hakim!5e0!3m2!1sen!2sid!4v1777024190871!5m2!1sen!2sid"
                    width="100%"
                    height="280"
                    style="border:0; border-radius: 10px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi SMA Negeri 27 Jakarta"
                ></iframe>
            </div>
 
            <div class="ks-info-block">
                <div class="ks-info-item">
                    <span class="ks-info-icon">🕐</span>
                    <div>
                        <p class="ks-info-title">Jam Operasional</p>
                        <p class="ks-info-text">Senin - Jumat: 06.30 - 15.00</p>
                        <p class="ks-info-text">Sabtu - Minggu: Tutup</p>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</section>

{{-- ===== FAQ SECTION ===== --}}
<section class="faq-section">
    <div class="faq-container">
 
        <div class="faq-heading">
            <span class="faq-label">F.A.Q</span>
            <h2 class="faq-title">Need-to-Know Information</h2>
        </div>
 
        <div class="faq-list" id="faqList">
 
            <div class="faq-item active">
                <button class="faq-question" aria-expanded="true">
                    <span>Apa itu SMA ARH?</span>
                    <span class="faq-chevron">&#9650;</span>
                </button>
                <div class="faq-answer">
                    <p>SMA ARH Tangsel adalah Sekolah Menengah Atas Swasta yang berkomitmen untuk mencetak lulusan yang tidak hanya memiliki pengetahuan dan keterampilan teknis yang kuat, tetapi juga memiliki soft skills yang dibutuhkan di dunia kerja. Dengan empat kompetensi keahlian yang relevan dengan industri, kami memberikan kesempatan bagi siswa untuk memilih program studi yang sesuai dengan minat dan bakatnya.</p>
                </div>
            </div>
 
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Program apa yang ditawarkan SMA ARH?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>SMA ARH menawarkan beberapa program keahlian di bidang teknologi informasi dan komunikasi yang relevan dengan kebutuhan industri saat ini.</p>
                </div>
            </div>
 
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Bagaimana cara mendaftar ke SMA ARH?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>Pendaftaran dapat dilakukan secara online melalui website resmi sekolah atau datang langsung ke kantor penerimaan siswa baru. Ikuti petunjuk yang tersedia dan lengkapi semua dokumen yang dibutuhkan.</p>
                </div>
            </div>
 
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Apa saja persyaratan untuk mendaftar ke SMA ARH?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>Persyaratan umum meliputi fotokopi ijazah/SKHUN SMP, fotokopi KK dan KTP orang tua, pas foto terbaru, dan dokumen pendukung lainnya sesuai ketentuan sekolah.</p>
                </div>
            </div>
 
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Berapa biaya pendaftaran ke SMA ARH?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>Informasi biaya pendaftaran dapat diperoleh dengan menghubungi pihak sekolah secara langsung atau melalui halaman kontak di website ini.</p>
                </div>
            </div>
 
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Kapan masa pendaftaran ke SMA ARH dibuka?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>Masa pendaftaran biasanya dibuka setiap tahun ajaran baru. Pantau terus website dan media sosial resmi sekolah untuk informasi jadwal penerimaan siswa baru terkini.</p>
                </div>
            </div>
 
        </div>
    </div>
</section>
 
<script>
document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.faq-item');
    items.forEach(function (item) {
        const btn = item.querySelector('.faq-question');
        btn.addEventListener('click', function () {
            const isActive = item.classList.contains('active');
            // Close all
            items.forEach(function (i) {
                i.classList.remove('active');
                i.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                i.querySelector('.faq-chevron').innerHTML = '&#9660;';
            });
            // Toggle clicked
            if (!isActive) {
                item.classList.add('active');
                btn.setAttribute('aria-expanded', 'true');
                item.querySelector('.faq-chevron').innerHTML = '&#9650;';
            }
        });
    });
});
</script>
@endsection