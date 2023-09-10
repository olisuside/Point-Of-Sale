@extends('layouts.app')

@section('title', 'Setting')

@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Data Produk</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('setting.update') }}" method="post" class="form-setting"
                                data-toggle="validator" enctype="multipart/form-data">
                                @csrf
                                <div class="alert alert-info alert-dismissible" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <i class="icon fa fa-check"></i> Perubahan berhasil disimpan
                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <label>Nama Perusahaan</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                                            class="form-control" required autofocus>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Telepon</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="text" name="telepon" id="telepon" class="form-control" required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Alamat</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="text" name="alamat" id="alamat" class="form-control" required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Logo Toko</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="file" name="path_logo" id="path_logo" class="form-control" onchange="preview('.tampil-logo', this.files[0])">
                                        <span class="help-block with-errors"></span>
                                        <br>
                                        <div class="tampil-logo"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Diskon</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="number" name="diskon" id="diskon" class="form-control" required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tipe Nota</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <select name="tipe_nota" class="form-control" id="tipe_nota" required>
                                            <option value="1">Nota Kecil</option>
                                            <option value="2">Nota Besar</option>
                                        </select>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                          Submit
                                        </button>
                                      </div>
                                    
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('scripts')
<script>
    $(function () {
        showData();

        $('.form-setting').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('.form-setting').attr('action'),
                    type: $('.form-setting').attr('method'),
                    data: new FormData($('.form-setting')[0]),
                    async: false,
                    processData: false,
                    contentType: false
                })
                .done(response => {
                    showData();
                    $('.alert').fadeIn();

                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
            }
        });
    });

    function showData() {
        $.get('{{ route('setting.show') }}')
            .done(response => {
                $('[name=nama_perusahaan]').val(response.nama_perusahaan);
                $('[name=telepon]').val(response.telepon);
                $('[name=alamat]').val(response.alamat);
                $('[name=diskon]').val(response.diskon);
                $('[name=tipe_nota]').val(response.tipe_nota);
                $('title').text(response.nama_perusahaan + ' | Pengaturan');
                
                let words = response.nama_perusahaan.split(' ');
                let word  = '';
                words.forEach(w => {
                    word += w.charAt(0);
                });
                $('.logo-mini').text(word);
                $('.logo-lg').text(response.nama_perusahaan);

                $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
                $('[rel=icon]').attr('href', `{{ url('/') }}/${response.path_logo}`);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }
</script>
@endpush