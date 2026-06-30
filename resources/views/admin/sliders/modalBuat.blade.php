<div class="modal fade modalBuat" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0">Buat Slider</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-simpan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 row">
                            <label class="col-sm-4">Title</label>
                            <div class="col-sm-8">
                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Deskripsi</label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" placeholder="Deskripsi" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Upload Images</label>
                            <div class="col-sm-8">
                                <input type="file" name="images" class="form-control">
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
                    <button type="button" class="btn btn-purple btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-green btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
