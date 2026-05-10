<div class="modal fade modalDetailOrder" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title m-0 text-white">Detail Order</h4>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 row">
                        <label class="col-sm-2">Referensi</label>
                        <div class="col-sm-10" id="detailOrderReferensi"></div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">Tanggal Order</label>
                        <div class="col-sm-10" id="detailTglOrder"></div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">Detail</label>
                        {{-- <div class="col-sm-8" id="detailOrder"></div> --}}
                        <div class="col-sm-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Deskripsi</th>
                                        <th>Lisensi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="detailOrder"></tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="mb-3 row">
                        <label class="col-sm-4">Deskripsi</label>
                        <div class="col-sm-8" id="detailLinkDescription"></div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12" id="detailLinkDownload"></div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
