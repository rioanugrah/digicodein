@extends('layouts.frontend.app')
@section('title')
{{-- {{ $product->product_name }} --}}
Checkout
@endsection
@section('css')
    <link href="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="fs-1 fw-bold mb-2">Pembayaran</div>
    <div class="row mb-4">
        <div class="col-md-12">
            <p>Terima kasih telah order dikami, kami akan mengirimkan invoice jika telah melakukan pembayaran.</p>
            <div class="mb-4">
                <div>Referensi : {{ $references }}</div>
                {{-- <div>Total : {{ 'Rp. '.number_format($product->product_price,0,',','.') }}</div> --}}
                <div>Total : {{ 'Rp. '.number_format($total,0,',','.') }}</div>
            </div>
            <button id="pay-button" class="btn btn-blue">Bayar Sekarang</button>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ env('MIDTRANS_IS_PRODUCTION') == false ? env('MIDTRANS_LINK_DEMO') : env('MIDTRANS_LINK_LIVE') }}" data-client-key="{{ env('MIDTRANS_IS_PRODUCTION') == false ? env('MIDTRANS_CLIENT_KEY_DEMO') : env('MIDTRANS_CLIENT_KEY_LIVE') }}"></script>
    <script src="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script>
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
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
                        if (result.isConfirmed) window.location.href="{{ route('user.home') }}"
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
        };
    </script>
@endsection
