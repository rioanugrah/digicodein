@extends('layouts.user.app')
@section('title')
    Cart
@endsection
@section('css')
    <link href="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <style>
        .cart-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        }

        .product-img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 15px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            background: #f1f3f5;
            border-radius: 12px;
            padding: 4px;
            width: fit-content;
        }

        .btn-qty {
            background: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #555;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .btn-qty:hover {
            background: #0d6efd;
            color: white;
        }

        .qty-input {
            width: 45px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
        }

        .cart-item-row {
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 25px;
            margin-bottom: 25px;
            transition: opacity 0.3s ease;
        }

        .cart-item-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .summary-card {
            background-color: #fff;
            position: sticky;
            top: 30px;
        }

        .btn-checkout {
            padding: 15px;
            border-radius: 14px;
            font-weight: 600;
            background: #0d6efd;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-checkout:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .remove-btn {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #fff5f5;
            color: #dc3545;
            text-decoration: none;
            transition: all 0.2s;
        }

        .remove-btn:hover {
            background: #dc3545;
            color: white;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "\F285";
            font-family: "bootstrap-icons";
            font-size: 0.6rem;
            color: #adb5bd;
        }
    </style>
@endsection
@section('content')
    <div class="row align-items-end mb-4">
        <div class="col">
            <h2 class="fw-bold m-0">Keranjang Belanja</h2>
            <p class="text-muted mb-0" id="item-count-info">Ada 1 item di keranjang Anda</p>
        </div>
    </div>

    <form action="{{ route('user.cartCheckout') }}" method="post">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="table-responsive d-none d-md-block">
                        <table class="table table-borderless align-middle">
                            <thead>
                                <tr class="text-muted small text-uppercase">
                                    <th scope="col" style="width: 45%;">Produk</th>
                                    <th scope="col" class="text-center">Kuantitas</th>
                                    <th scope="col" class="text-end">Harga</th>
                                    <th scope="col" class="text-end">Total</th>
                                    <th scope="col" class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                                <!-- Produk 1 -->
                                @foreach ($cart->cartItems as $key => $item)
                                    <tr class="cart-item-row" data-id="p{{ $key + 1 }}"
                                        data-price="{{ $item->product->product_price }}">
                                        <td>
                                            <input type="hidden" name="item_id[]" value="{{ $item->id.'|'.$item->product_id }}">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ Storage::disk('s3')->url($item->product->product_image_cover) }}"
                                                    alt="{{ $item->product->product_name }}" class="product-img me-3">
                                                <div>
                                                    <h6 class="mb-1 fw-bold">{{ $item->product->product_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantity-control mx-auto">
                                                <button type="button" class="btn-qty" onclick="updateQuantity('p{{ $key + 1 }}', -1)"><i
                                                        class="ri-subtract-fill"></i></button>
                                                <input type="text" name="qty[]" class="qty-input" id="qty-p{{ $key + 1 }}"
                                                    value="1" readonly>
                                                <button type="button" class="btn-qty" onclick="updateQuantity('p{{ $key + 1 }}', 1)"><i
                                                        class="ri-add-line"></i></button>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold">Rp
                                                {{ number_format($item->product->product_price, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold item-total" id="total-p{{ $key + 1 }}">Rp
                                                {{ number_format($item->product->product_price, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end">
                                                <button class="remove-btn border-0 delete"
                                                    onclick="removeItem('p{{ $key + 1 }}')"
                                                    data-id="{{ $item->id }}"><i class="ri-delete-bin-line"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty State Message -->
                    <div id="empty-cart-msg" class="text-center py-5 d-none">
                        <i class="bi bi-cart-x display-1 text-muted mb-3"></i>
                        <h4>Keranjang Kosong</h4>
                        <p class="text-muted">Sepertinya Anda belum menambahkan produk apapun.</p>
                    </div>

                    <div class="mt-4 border-top pt-4">
                        <a href="#" class="text-decoration-none fw-semibold">
                            <i class="bi bi-arrow-left me-2"></i>Kembali Berbelanja
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card summary-card p-4">
                    <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>

                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">Rp 0</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Pengiriman</span>
                        <span class="text-success">Gratis</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4 text-muted">
                        <span>Pajak (0%)</span>
                        <span id="summary-tax">Rp 0</span>
                    </div>

                    {{-- <div class="input-group mb-4">
                        <input type="text" class="form-control bg-light border-0" placeholder="Kode Promo"
                            style="padding: 12px; border-radius: 12px 0 0 12px;">
                        <button class="btn btn-dark px-3" type="button" style="border-radius: 0 12px 12px 0;">Gunakan</button>
                    </div> --}}

                    <hr class="my-4 opacity-50">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 fw-bold text-dark">Total Tagihan</span>
                        <span class="h5 fw-bold text-primary" id="summary-total">Rp 0</span>
                    </div>

                    <button class="btn btn-primary btn-checkout w-100 text-white shadow-lg" id="checkout-btn" type="submit">
                        Lanjut ke Pembayaran
                    </button>

                    <div class="mt-4 text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/196/196566.png" height="20" class="mx-1"
                            alt="Paypal">
                        <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" height="20" class="mx-1"
                            alt="Visa">
                        <img src="https://cdn-icons-png.flaticon.com/512/196/196561.png" height="20" class="mx-1"
                            alt="Mastercard">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.js"></script>

    <script>
        // Inisialisasi data produk dari atribut data- HTML
        const cartData = {
            taxRate: 0,
            items: {}
        };

        // Fungsi untuk memformat angka ke Rupiah
        const formatIDR = (amount) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        };

        // Fungsi untuk memperbarui kuantitas dan kalkulasi
        function updateQuantity(id, delta) {
            const input = document.getElementById(`qty-${id}`);
            const row = document.querySelector(`tr[data-id="${id}"]`);
            const price = parseInt(row.getAttribute('data-price'));

            let currentQty = parseInt(input.value);
            let newQty = currentQty + delta;

            if (newQty < 1) return;

            input.value = newQty;

            // Update subtotal item
            const itemTotal = price * newQty;
            document.getElementById(`total-${id}`).innerText = formatIDR(itemTotal);

            calculateCart();
        }

        // Fungsi untuk menghitung total keseluruhan
        function calculateCart() {
            const rows = document.querySelectorAll('.cart-item-row');
            let subtotal = 0;
            let itemCount = 0;

            rows.forEach(row => {
                const id = row.getAttribute('data-id');
                const price = parseInt(row.getAttribute('data-price'));
                const qty = parseInt(document.getElementById(`qty-${id}`).value);

                subtotal += (price * qty);
                itemCount += qty;
            });

            const tax = subtotal * cartData.taxRate;
            const total = subtotal + tax;

            // Update UI Ringkasan
            document.getElementById('summary-subtotal').innerText = formatIDR(subtotal);
            document.getElementById('summary-tax').innerText = formatIDR(tax);
            document.getElementById('summary-total').innerText = formatIDR(total);
            document.getElementById('item-count-info').innerText = `Ada ${rows.length} item di keranjang Anda`;

            // Update Button State
            const checkoutBtn = document.getElementById('checkout-btn');
            if (rows.length === 0) {
                checkoutBtn.disabled = true;
                document.getElementById('cart-table-body').parentElement.classList.add('d-none');
                document.getElementById('empty-cart-msg').classList.remove('d-none');
            }
        }

        // Fungsi untuk menghapus item
        function removeItem(id) {
            const row = document.querySelector(`tr[data-id="${id}"]`);
            row.style.opacity = '0';
            setTimeout(() => {
                row.remove();
                calculateCart();
            }, 300);
        }

        // Jalankan perhitungan awal saat halaman dimuat
        window.onload = calculateCart;
    </script>
    <script>
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('user.cartDelete') }}',
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
                        });

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
        });
    </script>
@endsection
