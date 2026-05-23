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
                    <p>SMA ARH Tangsel adalah Sekolah Menengah Atas Swasta yang berkomitmen untuk mencetak lulusan yang
                        tidak hanya memiliki pengetahuan dan keterampilan teknis yang kuat, tetapi juga memiliki soft
                        skills yang dibutuhkan di dunia kerja. Dengan empat kompetensi keahlian yang relevan dengan
                        industri, kami memberikan kesempatan bagi siswa untuk memilih program studi yang sesuai dengan
                        minat dan bakatnya.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Program apa yang ditawarkan SMA ARH?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>SMA ARH menawarkan beberapa program keahlian di bidang teknologi informasi dan komunikasi yang
                        relevan dengan kebutuhan industri saat ini.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Bagaimana cara mendaftar ke SMA ARH?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>Pendaftaran dapat dilakukan secara online melalui website resmi sekolah atau datang langsung ke
                        kantor penerimaan siswa baru. Ikuti petunjuk yang tersedia dan lengkapi semua dokumen yang
                        dibutuhkan.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Apa saja persyaratan untuk mendaftar ke SMA ARH?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>Persyaratan umum meliputi fotokopi ijazah/SKHUN SMP, fotokopi KK dan KTP orang tua, pas foto
                        terbaru, dan dokumen pendukung lainnya sesuai ketentuan sekolah.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Berapa biaya pendaftaran ke SMA ARH?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>Informasi biaya pendaftaran dapat diperoleh dengan menghubungi pihak sekolah secara langsung atau
                        melalui halaman kontak di website ini.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Kapan masa pendaftaran ke SMA ARH dibuka?</span>
                    <span class="faq-chevron">&#9660;</span>
                </button>
                <div class="faq-answer">
                    <p>Masa pendaftaran biasanya dibuka setiap tahun ajaran baru. Pantau terus website dan media sosial
                        resmi sekolah untuk informasi jadwal penerimaan siswa baru terkini.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.faq-item');
        items.forEach(function(item) {
            const btn = item.querySelector('.faq-question');
            btn.addEventListener('click', function() {
                const isActive = item.classList.contains('active');
                // Close all
                items.forEach(function(i) {
                    i.classList.remove('active');
                    i.querySelector('.faq-question').setAttribute('aria-expanded',
                        'false');
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
