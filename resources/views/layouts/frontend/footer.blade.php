{{-- <footer class="footer-v3 pt-5 pb-4 mt-5">

    <div class="container position-relative z-1">
        <div class="row mb-4">
            <div class="col-lg-5 col-md-12 mb-4 pe-lg-5">
                <h3 class="text-white fw-bold mb-3">Digi<span class="text-danger">Codein</span></h3>
                <p>Kami mendedikasikan diri untuk memberikan layanan desain dan teknologi terbaik yang tidak
                    hanya indah dipandang, tetapi juga fungsional dan berdampak positif bagi komunitas
                    global.</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-white">Hubungi Kami</h5>
                <ul class="list-unstyled mt-3">
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-envelope fs-5 me-3"></i>
                        <span>support@digicodein.com</span>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-white mb-3">Ikuti Perjalanan Kami</h5>
                <p class="small">Tetap terhubung di media sosial untuk melihat proyek terbaru dan di balik
                    layar proses kreatif kami.</p>
                <div class="d-flex mt-3">
                    <a href="#" class="social-icon me-2"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="social-icon me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon me-2"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-spotify"></i></a>
                </div>
            </div>
        </div>

        <hr class="border-light opacity-25 mb-4">

        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <small>&copy; 2026 {{ env('APP_NAME') }}.</small>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="footer-link small me-3">Kebijakan Privasi</a>
                <a href="#" class="footer-link small">Ketentuan Layanan</a>
            </div>
        </div>
    </div>
</footer> --}}
<footer class="card pt-5 pb-4 bottom-0">
    <div class="card-body">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-12">
                    <img src="{{ asset('/') }}logo/LogoDigiCodein.png" style="width: 200px; height: 70px"
                            alt="Logo DigiCodein">
                    <p></p>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fw-bold fs-4 mb-3">Perusahaan</div>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="{{ route('frontend.tentang_kami') }}" class="footer-link">Tentang Kami</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('frontend.syarat_ketentuan') }}" class="footer-link">Syarat & Ketentuan</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('frontend.kebijakan_privasi') }}" class="footer-link">Kebijakan Privasi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold fs-4 mb-3">Hubungi Kami</div>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <div class="fw-bold">Team Support</div>
                                    <a href="#" class="footer-link">support@digicodein.com</a>
                                </li>
                                <li class="mb-2">
                                    <div class="fw-bold">Marketing</div>
                                    <a href="#" class="footer-link">marketing@digicodein.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- <footer class="pt-5 pb-4">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-12">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('/') }}logo/LogoDigiCodein.png" style="width: 200px; height: 70px"
                        alt="Logo DigiCodein">
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <h6 class="footer-title">Hubungi Kami</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link">support@digicodein.com</a></li>
                </ul>
            </div>
        </div>

        <div class="row mt-5 pt-4 border-top">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-muted small mb-0">&copy; 2026 {{ env('APP_NAME') }}.</p>
            </div>
        </div>
    </div>
</footer> -->
