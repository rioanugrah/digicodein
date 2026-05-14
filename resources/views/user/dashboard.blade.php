@extends('layouts.user.app')
@section('title')
    Dashboard
@endsection
@section('css')
    <link href="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @include('user.dashboard.modalDetailOrder')
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Order</h4>
                    <div class="table-responsive-sm mb-2">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Order</th>
                                    <th class="text-center">Billings</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->order_code }}</td>
                                        <td class="text-center">{{ json_decode($item->payments->payment_billing)->first_name.' '.json_decode($item->payments->payment_billing)->last_name }}</td>
                                        <td class="text-center">{{ 'Rp. '.number_format($item->total_price,0,',','.') }}</td>
                                        <td class="text-center">
                                            @switch($item->status)
                                                @case('Pending')
                                                    <span class="badge badge-yellow">{{ $item->status }}</span>
                                                    @break
                                                @case('Success')
                                                    <span class="badge badge-green">{{ $item->status }}</span>
                                                    @break
                                                @case('Cancelled')
                                                    <span class="badge badge-red">{{ $item->status }}</span>
                                                    @break
                                                @default

                                            @endswitch
                                        </td>
                                        <td class="text-center">
                                            <div class="flex-wrap gap-2 text-center">
                                                @switch($item->payments->payment_status)
                                                    @case('Unpaid')
                                                        <button type="button" class="btn btn-yellow btn-sm payment" data-id="{{ $item->payments->payment_token }}">Bayar Sekarang</a>
                                                        @break
                                                    @case('Paid')
                                                        <button type="button" class="btn btn-green btn-sm" onclick="orderDetail(`{{ $item->id }}`)"><i class="ri-eye-line me-1"></i> Detail</button>
                                                        <a href="{{ route('user.orderInvoice',['id' => $item->id]) }}" target="_blank" class="btn btn-blue btn-sm"><i class="ri-download-2-line me-1"></i> Invoice</a>
                                                        @break
                                                    @default

                                                @endswitch
                                                {{-- @if ($item->status == 'Success')
                                                <button type="button" class="btn btn-green btn-sm" onclick="orderDetail(`{{ $item->id }}`)"><i class="ri-eye-line me-1"></i> Detail</button>
                                                <a href="{{ route('user.orderInvoice',['id' => $item->id]) }}" target="_blank" class="btn btn-blue btn-sm"><i class="ri-download-2-line me-1"></i> Invoice</a>
                                                @endif --}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ env('MIDTRANS_IS_PRODUCTION') == false ? env('MIDTRANS_LINK_DEMO') : env('MIDTRANS_LINK_LIVE') }}" data-client-key="{{ env('MIDTRANS_IS_PRODUCTION') == false ? env('MIDTRANS_CLIENT_KEY_DEMO') : env('MIDTRANS_CLIENT_KEY_LIVE') }}"></script>

    <script>
        function orderDetail(id)
        {
            $.ajax({
                type: 'GET',
                url: "{{ url('order/') }}" + '/' + id,
                beforeSend: () => {
                    Swal.fire({
                        title: 'Loading...',
                        html: 'Please wait while we process your request',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: (result) => {
                    Swal.close();
                    document.getElementById('detailOrderReferensi').innerHTML = result.data.order_code;
                    document.getElementById('detailTglOrder').innerHTML = result.data.order_date;

                    // const orderItem = result.data.order_items;
                    // var txt = '';

                    const orderItems = result.data.order_items.map((value,index) => {
                        // return value.link_download;
                        // return '<div>'+
                        //             '<div class="mb-2">'+
                        //                 '<a href='+value.link_download+' target="_blank" class="btn btn-green btn-sm"><i class="ri-download-2-line me-1"></i>Download</a>'+
                        //             '</div>'+
                        //             '<div>'+value.link_description+'</div>'+
                        //         '</div>';
                        if (value.lisensi == null) {
                            var textLisensi = '-';
                        }else{
                            var textLisensi = value.lisensi;
                        }

                        return '<tr>'+
                                    '<td>'+value.order_item+'</td>'+
                                    '<td>'+value.link_description+'</td>'+
                                    '<td>'+textLisensi+'</td>'+
                                    '<td>'+
                                        '<a href='+value.link_download+' target="_blank" class="btn btn-green btn-sm"><i class="ri-download-2-line me-1"></i>Download</a>'+
                                    '</td>'+
                                '</tr>';
                    });

                    document.getElementById('detailOrder').innerHTML = orderItems;

                    $('.modalDetailOrder').modal('show');
                },
                error: function(request, status, error) {

                }
            });
        }

        $(document).on('click', '.payment', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            snap.pay(id, {
                onSuccess: function(result) {
                    // Tangani jika pembayaran berhasil
                    // alert('Pembayaran Berhasil');
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Pembayaran Telah Berhasil.',
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary mt-2',
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) window.location.reload();
                    });
                },
                onPending: function(result) {
                    // Tangani jika pembayaran pending
                    Swal.fire({
                        title: 'Menunggu!',
                        text: 'Sedang Menunggu Pembayaran.',
                        icon: 'warning',
                        customClass: {
                            confirmButton: 'btn btn-primary mt-2',
                        },
                        buttonsStyling: false
                    })
                },
                onError: function(result) {
                    // Tangani jika pembayaran gagal
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Pembayaran Gagal.',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary mt-2',
                        },
                        buttonsStyling: false
                    })
                }
            });
        });
    </script>
@endsection
