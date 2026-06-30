<div class="modal fade modalBuat" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0">Buat Produk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-simpan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 row">
                            <label class="col-sm-4">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" name="product_name" class="form-control" placeholder="Nama Produk">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Kategori</label>
                            <div class="col-sm-8">
                                <select name="product_category_id" class="form-control" id="">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($product_categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Produk Deskripsi</label>
                            <div class="col-sm-8">
                                <textarea name="product_description" class="form-control productDescription" placeholder="Produk Deskripsi" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Produk Link</label>
                            <div class="col-sm-8">
                                <textarea name="product_link" class="form-control" placeholder="Produk Link" id="" cols="30" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Produk Link Deskripsi</label>
                            <div class="col-sm-8">
                                <textarea name="product_link_description" class="form-control" placeholder="Produk Link Deskripsi" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Stok Produk</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" max="9999" name="product_quantity" class="form-control" placeholder="Stok Produk">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Harga Produk</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" name="product_price" class="form-control" placeholder="Harga Produk">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Gambar Produk Cover</label>
                            <div class="col-sm-8">
                                <input type="file" name="product_image_cover" class="form-control">
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
