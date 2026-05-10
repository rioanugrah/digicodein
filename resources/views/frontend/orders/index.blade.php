@extends('layouts.frontend.app')
@section('title')
Checkout
@endsection
@section('content')
    <div class="fs-1 fw-bold mb-2">Checkout</div>
    <form action="{{ route('frontend.checkout',['slug' => $product->slug]) }}" method="post" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="fw-bold fs-4 mb-3">Billing:</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="mb-2">Nama Depan</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Nama Depan" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="mb-2">Nama Belakang</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Nama Belakang" id="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="mb-2">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" id="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-2">No. Telepon</label>
                                    <input type="number" name="phone" class="form-control" placeholder="No. Telepon" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="fw-bold fs-4 mb-3">Detail Produk:</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fw-bold fs-3">{{ $product->product_name }}</div>
                            <div class="fw-bold fs-3">{{ 'Rp. '.number_format($product->product_price,0,',','.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="card bg-primary-new">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center text-white">
                            <div class="fw-bold fs-3">Total</div>
                            <div class="fw-bold fs-3">{{ 'Rp. '.number_format($product->product_price,0,',','.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center text-white">
                    <a href="{{ route('frontend.index') }}" class="btn btn-white w-100 fs-4" style="margin-right: 1%">Batal</a>
                    <button type="submit" class="btn btn-primary-new w-100 fs-4" style="margin-left: 1%">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </form>
@endsection
