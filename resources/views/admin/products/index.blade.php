@extends('layouts.admin.app')
@section('title')
    Produk
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('/') }}/assets/vendor/gridjs/theme/mermaid.min.css"> --}}
    <link href="{{ asset('/') }}assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @include('admin.products.modalBuat')
    @include('admin.products.modalDetail')
    @include('admin.products.modalEdit')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Produk</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="header-title">Produk</h4>
                </div>
                <div class="d-flex flex-wrap flex-lg-nowrap gap-2">
                    <button type="button" onclick="reload()" class="btn btn-blue"><i
                            class="ri-restart-line me-1"></i>Refresh</button>
                    <button type="button" onclick="buat()" class="btn btn-green"><i class="ri-add-line me-1"></i>Buat
                        Baru</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped mb-0" id="datatables">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/') }}assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js">
    </script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('/') }}assets/js/pages/ckeditor.js"></script>
    <script src="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.js"></script>

    <script>
        var table = $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.product') }}",
            columns: [{
                    data: 'product',
                    name: 'product'
                },
                {
                    data: 'product_description',
                    name: 'product_description'
                },
                {
                    data: 'product_price',
                    name: 'product_price'
                },
                {
                    data: 'product_quantity',
                    name: 'product_quantity'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                // { className: 'text-right', targets: [7, 10, 11, 14, 16] },
                {
                    className: 'text-center',
                    // targets: [0,1,3,4,5,6,7]
                    // targets: [1,2,4,5,6]
                },
            ],
        });

        ClassicEditor
            .create(document.querySelector('.productDescription'), {
                toolbar: ['bold', 'italic', 'numberedList', 'bulletedList']
            });

        function buat() {
            $('.modalBuat').modal('show');
        }

        function detail(id) {
            let product_description;

            $.ajax({
                type: 'GET',
                url: "{{ url('admin/products/') }}" + '/' + id,
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
                    // alert(result.success);
                    Swal.close();
                    document.getElementById('detailTitleProductName').innerHTML = result.data.product_name;
                    document.getElementById('detailProductName').innerHTML = result.data.product_name;
                    document.getElementById('detailProductPrice').innerHTML = 'Rp. ' + result.data.product_price
                        .toLocaleString('id-ID');
                    document.getElementById('detailProductQuantity').innerHTML = result.data.product_quantity;
                    document.getElementById('detailProductLink').innerHTML = result.data.product_link;
                    document.getElementById('detailProductLinkDescription').innerHTML = result.data
                        .product_link_description;
                    document.getElementById('detailProductDescription').innerHTML = result.data
                        .product_description;

                    $('.modalDetail').modal('show');
                },
                error: function(request, status, error) {

                }
            });
        }

        function edit(id) {
            let product_description;

            $.ajax({
                type: 'GET',
                url: "{{ url('admin/products/') }}" + '/' + id,
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
                    // alert(result.success);
                    Swal.close();
                    $('#edit_id').val(result.data.id);
                    $('#edit_product_category_id').val(result.data.product_category_id);
                    $('#edit_product_name').val(result.data.product_name);
                    // $('#edit_product_description').val(result.data.product_description);
                    ClassicEditor
                        .create(document.querySelector('#edit_product_description'), {
                            toolbar: ['bold', 'italic', 'numberedList', 'bulletedList']
                        })
                        .then(editor => {
                            editor.setData(result.data
                                .product_description); // Store instance for later AJAX use
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    $('#edit_product_link').val(result.data.product_link);
                    $('#edit_product_link_description').val(result.data.product_link_description);
                    $('#edit_product_price').val(result.data.product_price);
                    $('#edit_product_quantity').val(result.data.product_quantity);
                    // $('#edit_kategori').val(result.data.category);
                    $('#edit_status').val(result.data.status);
                    $('.modalEdit').modal('show');
                },
                error: function(request, status, error) {

                }
            });
        }

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
                        url: "{{ route('admin.product.simpan') }}",
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

                                table.ajax.reload(null, false);

                                this.reset;

                                $('.modalBuat').modal('hide');
                            } else {
                                Swal.close();
                                Swal.fire({
                                    title: 'Gagal',
                                    text: result.error,
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

        $('#form-update').submit(function(e) {
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
                        url: "{{ route('admin.product.update') }}",
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
                                Swal.fire({
                                    title: result.message_title,
                                    text: result.message_content,
                                    icon: 'success',
                                    customClass: {
                                        confirmButton: 'btn btn-primary mt-2',
                                    },
                                    buttonsStyling: false
                                })

                                this.reset;
                                table.ajax.reload(null, false);

                                $('.modalEdit').modal('hide');
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: result.error,
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-danger mt-2',
                                    },
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function(request, status, error) {
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

        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

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
                    // alert(id);
                    $.ajax({
                        url: '{{ route('admin.product.delete') }}',
                        method: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
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

                                table.ajax.reload(null, false);

                            } else {
                                Swal.close();

                                Swal.fire({
                                    title: 'Gagal',
                                    text: result.error,
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
                        }
                    });
                }
            });
        });
    </script>
@endsection
