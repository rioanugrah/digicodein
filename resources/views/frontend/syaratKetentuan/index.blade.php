@extends('layouts.frontend.app')
@section('title')
Tentang Kami
@endsection
@section('content')
    <article class="print-content">
        <div class="card border-light-subtle shadow-sm p-4 p-sm-5">
            
            <!-- Meta Info Header -->
            <div class="border-b pb-4 mb-4 border-bottom border-light-subtle text-center text-sm-start">
                <h2 class="h3 fw-black tracking-tight mb-3 text-uppercase">
                    Syarat dan Ketentuan Penggunaan Produk Digital Digicodein
                </h2>
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-sm-start gap-2" style="font-size: 0.8rem;">
                    <span class="badge bg-success-subtle text-success border border-success-subtle d-flex align-items-center gap-1.5 px-2.5 py-1.5 rounded-pill font-semibold">
                        <span class="bg-success rounded-circle d-inline-block" style="width: 6px; height: 6px;"></span>
                        Terbaru: 1 Juli 2026
                    </span>
                    <span class="text-muted d-none d-sm-inline">•</span>
                    <span class="text-muted fw-medium">Digicodein Legal Document</span>
                </div>
            </div>

            <!-- Welcome Text -->
            <p class="mb-5 leading-relaxed" style="font-size: 0.95rem; line-height: 1.7;">
                Selamat datang di <strong>Digicodein</strong>!
                <br><br>
                Syarat dan Ketentuan ini (selanjutnya disebut "Perjanjian") mengatur akses dan penggunaan Anda terhadap semua produk digital, layanan, perangkat lunak, kode sumber (<em>source code</em>), desain, <em>template</em>, dan dokumentasi terkait (secara kolektif disebut "Produk") yang disediakan oleh Digicodein.
                <br><br>
                Dengan membeli, mengunduh, mengakses, atau menggunakan Produk kami, Anda menyatakan bahwa Anda telah membaca, memahami, dan menyetujui untuk terikat oleh seluruh ketentuan dalam Perjanjian ini. Jika Anda tidak menyetujui syarat dan ketentuan ini, Anda tidak diperbolehkan untuk menggunakan atau mengakses Produk kami.
            </p>

            <!-- SECTION 1 -->
            <section id="definisi" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">1.</span> Definisi
                </h4>
                <ul class="list-unstyled d-flex flex-column gap-3" style="font-size: 0.95rem;">
                    <li class="d-flex align-items-start gap-2">
                        <i class="bi bi-dot text-primary fs-4 lh-1"></i>
                        <span><strong>"Digicodein"</strong> (selanjutnya disebut "Kami") merujuk pada pemilik, pengembang, dan penyedia Produk digital yang sah.</span>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="bi bi-dot text-primary fs-4 lh-1"></i>
                        <span><strong>"Pengguna"</strong> atau <strong>"Anda"</strong> merujuk pada individu, organisasi, atau entitas hukum yang membeli, mengunduh, atau menggunakan Produk dari Digicodein.</span>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="bi bi-dot text-primary fs-4 lh-1"></i>
                        <span><strong>"Produk Digital"</strong> merujuk pada semua aset digital yang dijual atau disediakan gratis oleh Digicodein, termasuk namun tidak terbatas pada aplikasi web, aplikasi seluler, <em>source code</em>, <em>template</em> desain, pustaka kode (<em>libraries</em>), dan plugin.</span>
                    </li>
                </ul>
            </section>

            <!-- SECTION 2 -->
            <section id="akun-pengguna" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">2.</span> Akun Pengguna
                </h4>
                <p style="font-size: 0.95rem;">
                    Untuk mengakses atau membeli beberapa Produk kami, Anda mungkin diharuskan untuk membuat akun. Anda bertanggung jawab penuh untuk:
                </p>
                <ol class="d-flex flex-column gap-2" style="font-size: 0.95rem;">
                    <li>Menjaga kerahasiaan informasi login dan kata sandi akun Anda.</li>
                    <li>Memastikan semua informasi yang Anda berikan adalah akurat, terkini, dan lengkap.</li>
                    <li>Menanggung semua aktivitas yang terjadi di bawah akun Anda.</li>
                    <li>Segera melaporkan kepada kami jika mendeteksi penggunaan akun tanpa izin atau pelanggaran keamanan lainnya.</li>
                </ol>
            </section>

            <!-- SECTION 3 -->
            <section id="lisensi" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">3.</span> Lisensi dan Penggunaan Produk
                </h4>
                <p class="mb-4" style="font-size: 0.95rem;">
                    Semua Produk yang disediakan oleh Digicodein dilindungi oleh undang-undang hak cipta dan kekayaan intelektual. Kecuali dinyatakan lain secara tertulis, pembelian Produk memberikan Anda <strong>Lisensi Non-Eksklusif, Terbatas, dan Tidak Dapat Dipindahtangankan</strong> dengan ketentuan sebagai berikut:
                </p>

                <!-- Sub-section A (Allowed) -->
                <div class="allowed-box bg-body-tertiary p-4 rounded-3 mb-3 border">
                    <h5 class="h6 fw-bold text-success d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-check-circle-fill"></i>
                        A. Penggunaan yang Diizinkan:
                    </h5>
                    <ul class="d-flex flex-column gap-2 mb-0" style="font-size: 0.9rem;">
                        <li>Menggunakan Produk untuk proyek pribadi atau komersial sesuai dengan jenis lisensi yang dibeli (misalnya, Lisensi Personal vs. Lisensi Developer/Komersial).</li>
                        <li>Melakukan modifikasi atau penyesuaian pada Produk (seperti mengubah kode atau desain) agar sesuai dengan kebutuhan proyek Anda.</li>
                    </ul>
                </div>

                <!-- Sub-section B (Prohibited) -->
                <div class="prohibited-box bg-danger-subtle border-danger-subtle p-4 rounded-3 border">
                    <h5 class="h6 fw-bold text-danger d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        B. Penggunaan yang Dilarang (Batasan Lisensi):
                    </h5>
                    <ul class="d-flex flex-column gap-2 mb-0" style="font-size: 0.9rem;">
                        <li><strong>Dilarang keras mendistribusikan ulang, menjual kembali, menyewakan, atau memberikan lisensi sub-pihak ketiga</strong> atas Produk kami dalam bentuk aslinya atau setelah dimodifikasi tanpa izin tertulis dari Digicodein.</li>
                        <li>Dilarang menggunakan Produk untuk tujuan ilegal, melanggar hukum, atau menyebarkan konten berbahaya/SARA.</li>
                        <li>Dilarang menghapus atau mengubah tanda hak cipta (<em>copyright notice</em>), merek dagang, atau atribusi kepemilikan Digicodein yang ada di dalam file Produk, kecuali lisensi yang Anda beli secara eksplisit mengizinkan penghapusan tersebut (<em>White-Label</em>).</li>
                    </ul>
                </div>
            </section>

            <!-- SECTION 4 -->
            <section id="pembayaran-refund" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">4.</span> Pembayaran, Harga, dan Pengembalian Dana (Refund)
                </h4>
                <ul class="d-flex flex-column gap-3 mb-0" style="font-size: 0.95rem;">
                    <li>
                        <strong>Harga:</strong> Semua harga Produk yang tertera di platform kami dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya. Harga yang berlaku adalah harga yang tertera pada saat transaksi berhasil diselesaikan.
                    </li>
                    <li>
                        <strong>Pembayaran:</strong> Pembayaran harus dilakukan penuh melalui metode pembayaran resmi yang kami sediakan sebelum Produk dapat diunduh atau diakses.
                    </li>
                    <li>
                        <strong>Kebijakan Pengembalian Dana (Refund):</strong> Karena sifat Produk kami adalah barang digital (dapat diunduh secara instan dan tidak dapat dikembalikan secara fisik), <strong>semua penjualan adalah final dan tidak dapat di-refund</strong>. Namun, pengecualian dapat dipertimbangkan jika:
                        <ol class="mt-2 list-unstyled bg-body-tertiary border p-3 rounded-3 d-flex flex-column gap-2" style="font-size: 0.875rem;">
                            <li class="d-flex gap-2">
                                <span class="fw-bold text-primary">4.1</span>
                                <span>Produk mengalami kerusakan teknis bawaan (<em>corrupted file</em>) yang tidak dapat diperbaiki oleh tim dukungan kami dalam waktu 14 hari kerja setelah pelaporan.</span>
                            </li>
                            <li class="d-flex gap-2">
                                <span class="fw-bold text-primary">4.2</span>
                                <span>Anda belum pernah mengunduh file Produk sama sekali sejak transaksi berhasil dilakukan.</span>
                            </li>
                        </ol>
                    </li>
                </ul>
            </section>

            <!-- SECTION 5 -->
            <section id="support-updates" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">5.</span> Dukungan Teknis (Support) dan Pembaruan (Updates)
                </h4>
                <ul class="d-flex flex-column gap-3 mb-0" style="font-size: 0.95rem;">
                    <li>
                        <strong>Pembaruan Produk:</strong> Digicodein dapat merilis pembaruan, perbaikan bug, atau peningkatan fitur secara berkala untuk Produk tertentu. Akses ke pembaruan ini bergantung pada syarat saat Anda membeli Produk (misalnya, pembaruan gratis selamanya atau berlangganan tahunan).
                    </li>
                    <li>
                        <strong>Dukungan Teknis:</strong> Kami menyediakan dukungan teknis terbatas terkait instalasi dan masalah bawaan Produk sesuai dengan jam kerja operasional kami. Dukungan ini <strong>tidak mencakup</strong> layanan kustomisasi kode (<em>custom coding</em>) yang mendalam atau integrasi dengan sistem pihak ketiga yang tidak didukung sejak awal.
                    </li>
                </ul>
            </section>

            <!-- SECTION 6 -->
            <section id="kekayaan-intelektual" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">6.</span> Hak Kekayaan Intelektual
                </h4>
                <p style="font-size: 0.95rem;">
                    Seluruh hak cipta, merek dagang, paten, rahasia dagang, dan hak kekayaan intelektual lainnya pada Produk, situs web, serta materi pemasaran Digicodein tetap menjadi milik penuh Digicodein. Anda tidak memperoleh hak kepemilikan apa pun atas Produk kami selain hak terbatas untuk menggunakannya sesuai lisensi yang ditentukan dalam Perjanjian ini.
                </p>
            </section>

            <!-- SECTION 7 -->
            <section id="batasan-tanggung-jawab" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">7.</span> Batasan Tanggung Jawab
                </h4>
                <ul class="d-flex flex-column gap-3 mb-0" style="font-size: 0.95rem;">
                    <li>
                        <strong>Garansi "Sebagaimana Adanya":</strong> Semua Produk disediakan "sebagaimana adanya" (<em>as is</em>) dan "sebagaimana tersedia" (<em>as available</em>) tanpa garansi dalam bentuk apa pun, baik tersurat maupun tersirat. Kami tidak menjamin bahwa Produk akan bebas dari kesalahan (<em>error-free</em>), bebas bug, atau bekerja tanpa gangguan.
                    </li>
                    <li>
                        <strong>Batasan Kerugian:</strong> Digicodein tidak bertanggung jawab atas kerugian tidak langsung, insidental, khusus, atau konsekuensial, termasuk namun tidak terbatas pada hilangnya keuntungan, kehilangan data, atau gangguan bisnis yang timbul dari penggunaan atau ketidakmampuan menggunakan Produk kami, bahkan jika kami telah diberitahu tentang potensi kerugian tersebut.
                    </li>
                </ul>
            </section>

            <!-- SECTION 8 -->
            <section id="perubahan-syarat" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">8.</span> Perubahan Syarat dan Ketentuan
                </h4>
                <p style="font-size: 0.95rem;">
                    Digicodein berhak untuk memperbarui atau mengubah Syarat dan Ketentuan ini kapan saja tanpa persetujuan pengguna sebelumnya. Perubahan akan berlaku segera setelah kami mengunggah dokumen terbaru di situs web kami. Anda disarankan untuk memeriksa halaman ini secara berkala. Penggunaan Produk secara terus-menerus setelah perubahan tersebut dianggap sebagai persetujuan Anda terhadap dokumen yang diperbarui.
                </p>
            </section>

            <!-- SECTION 10 -->
            <section id="kontak-kami" class="py-4 border-top border-light-subtle">
                <h4 class="fw-bold mb-3">
                    <span class="text-purple" style="color: var(--brand-primary)">09.</span> Kontak Kami
                </h4>
                <p style="font-size: 0.95rem;">
                    Jika Anda memiliki pertanyaan, keluhan, atau memerlukan klarifikasi lebih lanjut mengenai Syarat dan Ketentuan ini, silakan hubungi kami di:
                </p>
                <div class="row g-3">
                    <!-- Email Card -->
                    <div class="col-12 col-sm-6">
                        <div class="p-3 bg-body-tertiary border rounded-3 d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded" style="width: 48px; height: 48px;">
                                <i class="bi bi-envelope fs-5"></i>
                            </div>
                            <div>
                                <small class="text-uppercase text-muted fw-bold d-block" style="font-size: 0.65rem; letter-spacing: 0.5px;">Email Dukungan</small>
                                <a href="mailto:support@digicodein.com" class="fw-bold text-decoration-none" style="color: var(--brand-primary);">support@digicodein.com</a>
                            </div>
                        </div>
                    </div>
                    <!-- Web Card -->
                    <div class="col-12 col-sm-6">
                        <div class="p-3 bg-body-tertiary border rounded-3 d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center bg-info-subtle text-info rounded" style="width: 48px; height: 48px;">
                                <i class="bi bi-globe fs-5"></i>
                            </div>
                            <div>
                                <small class="text-uppercase text-muted fw-bold d-block" style="font-size: 0.65rem; letter-spacing: 0.5px;">Situs Web</small>
                                <a href="https://www.digicodein.com" target="_blank" class="fw-bold text-decoration-none text-info-emphasis">www.digicodein.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </article>
@endsection