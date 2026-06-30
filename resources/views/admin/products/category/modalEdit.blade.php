<div class="modal fade modalEdit" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0">Edit Kategori</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-update" method="post">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 row">
                            <label class="col-sm-4">Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" name="category" class="form-control" placeholder="Kategori" id="edit_kategori">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Icon</label>
                            <div class="col-sm-8">
                                <input type="text" name="icon" class="form-control" placeholder="Icon" id="edit_icon">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Status</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control" id="edit_status">
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
                    <button type="submit" class="btn btn-green btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
