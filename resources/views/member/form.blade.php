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
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required autofocus>
                        </div>

                        <div class="col-md-4">
                            <label>Telepon</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Telepon" required>
                        </div>

                        <div class="col-md-4">
                            <label>Harga Beli</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="alamat" id="alamat" 
                                placeholder="Alamat" required>
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