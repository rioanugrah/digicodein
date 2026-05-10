@extends('layouts.admin.app')
@section('title')
    Transactions
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
    <link href="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    @include('admin.payments.modalDetail')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Transactions</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Transactions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                    <div class="flex-grow-1">
                        <h4 class="header-title">Transactions</h4>
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
                                    <th>Tanggal Pembayaran</th>
                                    <th>Referensi</th>
                                    <th>Billing</th>
                                    <th>Admin</th>
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
    <script src="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.js"></script>

    <script>
        var table = $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.transaction.index') }}",
            columns: [
                {
                    data: 'tanggal_pembayaran',
                    name: 'tanggal_pembayaran'
                },
                {
                    data: 'references',
                    name: 'references'
                },
                {
                    data: 'billings',
                    name: 'billings'
                },
                {
                    data: 'fee_admin',
                    name: 'fee_admin'
                },
                {
                    data: 'total',
                    name: 'total'
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
                    // $('#edit_product_category_id').val(result.data.product_category_id);
                    document.getElementById('detailReferensi').innerHTML = result.data.payment_references;
                    document.getElementById('detailTanggalPembayaran').innerHTML = result.data.payment_date;
                    document.getElementById('detailMethod').innerHTML = result.data.payment_method;
                    document.getElementById('detailAdmin').innerHTML = result.data.fee_admin;
                    document.getElementById('detailTotal').innerHTML = result.data.total;
                    $('.modalDetail').modal('show');
                },
                error: function(request, status, error) {

                }
            });
        }
    </script>
@endsection
