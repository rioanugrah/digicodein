@extends('layouts.frontend.app')
@section('title')
DigiCodein
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                {{-- <ol class="carousel-indicators">
                    @foreach ($sliders as $key => $item)
                        @if ($key == 0)
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="active"></li>
                        @else
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"></li>
                        @endif
                    @endforeach
                </ol> --}}
                <div class="carousel-inner" role="listbox">
                    @foreach ($sliders as $key => $item)
                        @if ($key == 0)
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="{{ Storage::disk('s3')->url($item->images) }}">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="{{ Storage::disk('s3')->url($item->images) }}">
                        </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
        <div class="col-lg-12">
            @foreach ($categorys as $item)
                <section class="py-5">
                    <div class="">
                        <div class="section-header">
                            <div class="section-title-blue">{!! $item->icon !!} {{ $item->category }}</div>
                            <a href="{{ route('frontend.category_product',['slug' => $item->slug]) }}" class="btn btn-primary-new">Lihat Lainnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-6">
                            @foreach ($item->products as $product)
                                <a href="{{ route('frontend.product_detail',['slug' => $product->slug]) }}" class="col">
                                    <div class="product-card">
                                        <div class="price-badge">
                                            {{ 'Rp. ' . number_format($product->product_price - 0, 0, ',', '.') }}
                                        </div>
                                        <div class="product-img-container">
                                            <img src="{{ Storage::disk('s3')->url($product->product_image_cover) }}">
                                        </div>
                                        <div class="product-footer-blue">
                                            {{ $product->product_name }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </div>
@endsection
