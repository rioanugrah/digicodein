<div class="modal fade" id="modalCart" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <form id="form-simpan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="fs-4 fw-bold">{{ $product->product_name }}</div>
                    <div class="mt-3 mb-3 row">
                        <label class="col-sm-4">Jumlah</label>
                        <div class="col-sm-8">
                            <input type="number" name="quantity" class="form-control">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
