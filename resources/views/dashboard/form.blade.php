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
            <form  action="{{ route('dashboard.index') }}" method="get" data-toggle="validator" >
               

                <div class="modal-body form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="tanggal_awal" class="">Tanggal Awal</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control datepicker" required autofocus
                                value="{{ request('tanggal_awal') }}"
                                style="border-radius: 0 !important;">
                            <span class="help-block with-errors"></span>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="tanggal_akhir" class="">Tanggal Akhir</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control datepicker" required
                                value="{{ request('tanggal_akhir') ?? date('Y-m-d') }}"
                                style="border-radius: 0 !important;">
                            <span class="help-block with-errors"></span>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary" ><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>