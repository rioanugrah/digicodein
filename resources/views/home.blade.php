{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.admin.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row row-cols-xxl-4 row-cols-md-4 row-cols-1">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Total Tansaksi">
                                Total Tansaksi</h5>
                            <h3 class="my-2 py-1 fw-bold">{{ 'Rp. '.number_format($total_transaksi,0,',','.') }}</h3>
                            {{-- <p class="mb-0 text-muted">
                                <span class="text-danger me-1"><i class="ri-arrow-left-down-box-line"></i>
                                    9.19%</span>
                                <span class="text-nowrap">Semua</span>
                            </p> --}}
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-42">
                                <iconify-icon icon="solar:card-search-line-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Transaksi Berhasil">Transaksi Berhasil</h5>
                            <h3 class="my-2 py-1 fw-bold">{{ 'Rp. '.number_format($total_transaksi_berhasil,0,',','.') }}</h3>
                            {{-- <p class="mb-0 text-muted">
                                <span class="text-success me-1"><i class="ri-arrow-left-up-box-line"></i>
                                    4.67%</span>
                                <span class="text-nowrap">Berhasil</span>
                            </p> --}}
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-42">
                                <iconify-icon icon="solar:card-transfer-line-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Transaksi Pending">Transaksi Pending</h5>
                            <h3 class="my-2 py-1 fw-bold">{{ 'Rp. '.number_format($total_transaksi_menunggu,0,',','.') }}</h3>
                            {{-- <p class="mb-0 text-muted">
                                <span class="text-success me-1"><i class="ri-arrow-left-up-box-line"></i>
                                    4.67%</span>
                                <span class="text-nowrap">Pending</span>
                            </p> --}}
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-42">
                                <iconify-icon icon="solar:card-transfer-line-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Transaksi Gagal">Transaksi Gagal</h5>
                            <h3 class="my-2 py-1 fw-bold">{{ 'Rp. '.number_format($total_transaksi_gagal,0,',','.') }}</h3>
                            {{-- <p class="mb-0 text-muted">
                                <span class="text-success me-1"><i class="ri-arrow-left-up-box-line"></i>
                                    2.85%</span>
                                <span class="text-nowrap">Gagal</span>
                            </p> --}}
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-42">
                                <iconify-icon icon="solar:card-search-outline"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

    </div>
@endsection
