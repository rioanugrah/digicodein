@extends('layouts.admin.app')
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
    <link href="{{ asset('/') }}assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
@endsection
@section('title')
    Kategori Produk
@endsection
@section('content')
    @include('admin.products.category.modalBuat')
    @include('admin.products.category.modalEdit')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Kategori Produk</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Kategori Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="header-title">Kategori Produk</h4>
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
                                <th>Slug</th>
                                <th>Kategori</th>
                                <th>Icon</th>
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
    {{-- <script src="{{ asset('/') }}/assets/vendor/gridjs/gridjs.umd.js"></script> --}}
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

    <script>
        var table = $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.product_category') }}",
            columns: [{
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'icon',
                    name: 'icon'
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

        function reload() {
            table.ajax.reload(null, false);
        }

        function buat() {
            $('.modalBuat').modal('show');
        }

        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            // alert(id);
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/product_category/') }}" + '/' + id,
                beforeSend: () => {

                },
                success: (result) => {
                    // alert(result.success);
                    $('#edit_id').val(result.data.id);
                    $('#edit_kategori').val(result.data.category);
                    $('#edit_icon').val(result.data.icon);
                    $('#edit_status').val(result.data.status);
                    $('.modalEdit').modal('show');
                },
                error: function(request, status, error) {

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
                        url: '{{ route("admin.product_category.delete") }}',
                        method: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        beforeSend: () => {

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
                                table.ajax.reload(null, false);
                            }else{
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

                        }
                    });
                }
            });
        });

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
                        url: "{{ route('admin.product_category.simpan') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: () => {

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

                                table.ajax.reload(null, false);

                                $('.modalBuat').modal('hide');
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
                        url: "{{ route('admin.product_category.update') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: () => {

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

        // $(document).on('click', '.active_btn', function(e) {
        //     e.preventDefault();
        //     let id = $(this).data('id');
        //     $.ajax({
        //         url: '',
        //         method: 'PATCH',
        //         data: {
        //             id: id,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             console.log(response);
        //         }
        //     });
        // });
    </script>
    {{-- <script src="{{ asset('/') }}/assets/js/components/table-gridjs.js"></script> --}}
@endsection
