{{-- modal produk --}}
<div class="modal fade text-left modal-borderless" id="modal-form" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33"></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="modal-body form-body">
                    <div class="row">

                        <div class="col-md-4">
                            <label>Nama Produk</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" required
                                autofocus>
                        </div>


                        <div class="col-md-4">
                            <label>Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="id_kategori" id="id_kategori" class="form-select" required>
                                <option  selected disabled  value="">Pilih Kategori</option>
                                @foreach ($kategori as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Merk</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" id="merk" name="merk"
                                placeholder="Merk" required>
                        </div>

                        <div class="col-md-4">
                            <label>Harga Beli</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="harga_beli" id="harga_beli"
                                placeholder="0" required>
                        </div>

                        <div class="col-md-4">
                            <label>Harga Jual</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="harga_jual" id="harga_jual"
                                placeholder="0" required>
                        </div>

                        <div class="col-md-4">
                            <label>Diskon</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="diskon" id="diskon"
                                placeholder="0" required value="0">
                        </div>

                        <div class="col-md-4">
                            <label>Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="stok" name="stok"
                                placeholder="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block submit-text"></span>
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
{{-- modal end --}}
