@extends('layouts.admin.app')
@section('title')
    Orders
@endsection
@section('css')
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
@endsection
@section('content')
    @include('admin.orders.modalDetailOrder')
    @include('admin.orders.modalLisensi')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Orders</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                    <div class="flex-grow-1">
                        <h4 class="header-title">Orders</h4>
                    </div>
                    <div class="d-flex flex-wrap flex-lg-nowrap gap-2">
                        <button type="button" onclick="reload()" class="btn btn-blue"><i
                                class="ri-restart-line me-1"></i>Refresh</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-striped mb-0" id="datatables">
                            <thead>
                                <tr>
                                    <th>Tanggal Order</th>
                                    <th>Kode Order</th>
                                    <th>Billings</th>
                                    <th>Total</th>
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

    <script>
        var table = $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.orders.index') }}",
            columns: [
                {
                    data: 'tgl_order',
                    name: 'tgl_order'
                },
                {
                    data: 'order_code',
                    name: 'order_code'
                },
                {
                    data: 'billings',
                    name: 'billings'
                },
                {
                    data: 'total_price',
                    name: 'total_price'
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
            order: [0]
        });

        function reload()
        {
            table.ajax.reload(null, false);
        }

        function detail(id)
        {
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/transactions/') }}" + '/' + id,
                beforeSend: () => {

                },
                success: (result) => {
                    // $('#edit_product_category_id').val(result.data.product_category_id);
                    document.getElementById('detailReferensi').innerHTML = result.data.payment_references;
                    document.getElementById('detailMethod').innerHTML = result.data.payment_method;
                    document.getElementById('detailAdmin').innerHTML = result.data.fee_admin;
                    document.getElementById('detailTotal').innerHTML = result.data.total;
                    $('.modalDetail').modal('show');
                },
                error: function(request, status, error) {

                }
            });
        }

        function orderDetail(id)
        {
            $.ajax({
                type: 'GET',
                url: "{{ url('/admin/orders/') }}" + '/' + id,
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

                    const orderItems = result.data.order_items.map((value,index) => {
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
                    Swal.close();
                }
            });
        }

        function detailLisensi(id)
        {
            $.ajax({
                type: 'GET',
                url: "{{ url('/admin/orders/') }}" + '/' + id,
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

                    $('#lisensi_id').val(result.data.id);
                    document.getElementById('detailLisensiReferensi').innerHTML = result.data.order_code;
                    document.getElementById('detailLisensiTglOrder').innerHTML = result.data.order_date;

                    const orderItems = result.data.order_items.map((value,index) => {
                        if (value.lisensi == null) {
                            var textLisensi = '<textarea name="lisensi[]" class="form-control">'+value.lisensi+'</textarea>';
                        }else{
                            var textLisensi = value.lisensi;
                        }

                        return '<tr>'+
                                    '<td>'+value.order_item+'</td>'+
                                    '<td>'+textLisensi+'</td>'+
                                    // '<td>'+
                                    //     '<button type="button" class="btn btn-yellow btn-sm"><i class="ri-key-2-line me-1"></i>Edit</button>'+
                                    // '</td>'+
                                '</tr>';
                    });

                    document.getElementById('detailLisensi').innerHTML = orderItems;

                    $('.modalLisensi').modal('show');
                },
                error: function(request, status, error) {
                    Swal.close();
                }
            });
        }

        $('#lisensi-simpan').submit(function(e) {
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
                        url: "{{ route('admin.orders.lisensiSimpan') }}",
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

                                this.reset();

                                $('.modalLisensi').modal('hide');
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
    </script>
@endsection
