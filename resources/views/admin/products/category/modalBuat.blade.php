<div class="modal fade modalBuat" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0">Buat Kategori</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-simpan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 row">
                            <label class="col-sm-4">Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" name="category" class="form-control" placeholder="Kategori">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Icon</label>
                            <div class="col-sm-8">
                                <input type="text" name="icon" class="form-control" placeholder="Icon">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Status</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control" id="">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Active">Aktif</option>
                                    <option value="Inactive">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
