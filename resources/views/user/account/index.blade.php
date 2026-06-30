@extends('layouts.user.app')
@section('title')
    Account
@endsection
@section('css')
    <link href="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Account</h4>
            <form id="form-simpan" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="fw-bold">First Name</label>
                            @if (empty(auth()->user()->profile->first_name))
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" id="">
                            @else
                            <div>{{ $user->profile->first_name }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="fw-bold">Last Name</label>
                            @if (empty(auth()->user()->profile->last_name))
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" id="">
                            @else
                            <div>{{ $user->profile->last_name }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="fw-bold">Email</label>
                            <div>{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="fw-bold">Phone Number</label>
                            @if (empty(auth()->user()->profile->phone_number))
                            <input type="number" name="phone_number" class="form-control" value="{{ $user->phone_number }}" id="">
                            @else
                            <div>{{ $user->profile->phone_number }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <a href="{{ route('user.home') }}" class="btn btn-secondary">Back</a>
                @if (empty(auth()->user()->profile))
                <button type="submit" class="btn btn-green">Simpan</button>
                @else
                <a href="#" class="btn btn-yellow">Edit</a>
                @endif
            </form>
        </div>
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
                        url: "{{ route('user.account.update') }}",
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
    </script>
@endsection
