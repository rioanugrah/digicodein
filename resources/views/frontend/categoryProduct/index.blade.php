@extends('layouts.frontend.app')
@section('title')
    {{ $listProduct->category }}
@endsection
@section('content')
    <h1 class="fs-3 mb-3">{{ $listProduct->category }}</h1>
    <div class="col-lg-12 mb-4">
        <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-6">
            @foreach ($listProduct->products as $product)
                <a href="{{ route('frontend.product_detail', ['slug' => $product->slug]) }}" class="col">
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
@endsection
