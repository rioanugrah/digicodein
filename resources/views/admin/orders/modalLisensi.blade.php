<div class="modal fade modalLisensi" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title m-0 text-white">Lisensi</h4>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="lisensi-simpan" method="post">
                @csrf
                <input type="hidden" name="lisensi_order_id" id="lisensi_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 row">
                            <label class="col-sm-2">Referensi</label>
                            <div class="col-sm-10" id="detailLisensiReferensi"></div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">Tanggal Order</label>
                            <div class="col-sm-10" id="detailLisensiTglOrder"></div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">Detail</label>
                            {{-- <div class="col-sm-8" id="detailOrder"></div> --}}
                            <div class="col-sm-10">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Lisensi</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="detailLisensi"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-green">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
