@extends('layouts.frontend.app')
@section('title')
Tentang Kami
@endsection
@section('content')
    <section class="hero d-flex align-items-center mt-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3 p-2 px-3">Inovasi Teknologi 2026</span>
                    <h1 class="display-3 fw-bold mb-4">Membangun Masa Depan Bisnis Digital Anda</h1>
                    <p class="lead mb-4">Digicodein adalah ruang kreatif bagi para developer, kreator, dan pemikir digital untuk berkumpul. Kami mengembangkan platform web dengan standar performa tinggi, memastikan setiap interaksi pengguna terasa mulus dan berdampak.</p>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <img src="https://placehold.co/600x400/0d6efd/ffffff?text=Digital+Innovation" class="img-fluid rounded-4 shadow" alt="Hero">
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Keunggulan Produk Kami</h2>
                <p class="text-muted">Teknologi mutakhir untuk kebutuhan spesifik bisnis Anda.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-service p-4 h-100">
                        <i class="bi bi-graph-up text-primary fs-1 mb-3"></i>
                        <h4 class="text-center">Kepercayaan Tinggi</h4>
                        <!--<p>Platform berbasis langganan untuk manajemen bisnis yang lebih cerdas dan efisien.</p>-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-service p-4 h-100">
                        <i class="bi bi-phone text-primary fs-1 mb-3"></i>
                        <h4 class="text-center">Harga Terjangkau</h4>
                        <!--<p>Pengembangan aplikasi iOS & Android dengan antarmuka yang elegan dan responsif.</p>-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-service p-4 h-100">
                        <i class="bi bi-cloud-check text-primary fs-1 mb-3"></i>
                        <h4 class="text-center">Pengiriman Cepat</h4>
                        <!--<p>Infrastruktur awan yang menjamin keamanan data dan skalabilitas tinggi.</p>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection