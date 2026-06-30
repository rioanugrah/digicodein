@extends('layouts.frontend.app')
@section('title')
{{ $product->product_name }}
@endsection
@section('css')
    <link href="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ Storage::disk('s3')->url($product->product_image_cover) }}" width="300">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-bold fs-3">{{ $product->product_name }}</h1>
                    <div class="fs-3 fw-bold mb-3">{{ 'Rp. '.number_format($product->product_price,0,',','.') }}</div>
                    <div class="fw-bold mb-3">Deskripsi :</div>
                    {!! $product->product_description !!}
                </div>
            </div>
            <form id="form-simpan" method="post">
                @csrf
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    @auth
                        <button type="submit" class="btn btn-green w-100 fs-4 me-1"><i class="ri-shopping-cart-2-line me-1"></i>Tambah Keranjang</button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-green w-100 fs-4 me-1"><i class="ri-shopping-cart-2-line me-1"></i>Tambah Keranjang</a>
                    @endauth
                        {{-- <a href="{{ route('frontend.order',['slug' => $product->slug]) }}" class="btn btn-primary-new w-100 fs-4 ml-1"><i class="ri-add-line me-1"></i> Beli Sekarang</a> --}}
                </div>
            </form>
        </div>
        {{-- <div class="col-md-12">
            <div class="fs-3 text-center">Produk Rekomendasi</div>
        </div> --}}
    </div>
@endsection
@section('js')
    <script src="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            Swal.fire({
                title: "Apakah Sudah Yakin?",
                text: "Anda tidak dapat mengubah setelah submit",
                icon: "warning",
                showCancelButton: true,
                customClass: {
                    confirmButton: 'btn btn-primary me-2 mt-2',
                    cancelButton: 'btn btn-danger mt-2',
                },
                confirmButtonText: "Ya, Submit",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('user.cartAdd',['slug' => $product->slug]) }}",
                        data: formData,
                        contentType: false,
                        processData: false,
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
                            if (result.success == true) {
                                Swal.close();

                                Swal.fire({
                                    title: result.message_title,
                                    text: result.message_content,
                                    icon: 'success',
                                    customClass: {
                                        confirmButton: 'btn btn-primary mt-2',
                                    },
                                    buttonsStyling: false
                                })
                            } else {
                                Swal.close();
                                Swal.fire({
                                    title: 'Gagal',
                                    text: result.message_content,
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-danger mt-2',
                                    },
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function(request, status, error) {
                            Swal.close();
                            Swal.fire({
                                title: 'Error',
                                text: error,
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-danger mt-2',
                                },
                                buttonsStyling: false
                            })
                        }
                    });
                }
            });
        });
    </script>
@endsection
