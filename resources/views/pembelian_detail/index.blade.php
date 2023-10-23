@extends('layouts.app')

@section('title', 'Pembelian')

@push('css')
    <style>
        .tampil-bayar {
            font-size: 4em;
            text-align: center;
            align-items: center;
            height: 100px;
            color: white;
        }

        .tampil-terbilang {
            padding: 10px;
            background: primary;
            text-align: center;
            align-items: center;
        }

        #table-pembelian tbody tr:last-child {
            display: none;
        }

        @media(max-width: 768px) {
            .tampil-bayar {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush

@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body py-1" style="font-size: smaller">
                            <table class="table table-borderless my-1">
                                <tr class="row">
                                    <td class="col-lg-2 col-md-4">Supplier</td>
                                    <td class="col-lg-2 col-md-4">: {{ $supplier->nama }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="col-lg-2 col-md-4">Telepon</td>
                                    <td class="col-lg-2 col-md-4">: {{ $supplier->telepon }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="col-lg-2 col-md-4">Alamat</td>
                                    <td class="col-lg-2 col-md-4">: {{ $supplier->alamat }}</td>
                                </tr>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form class="form-produk">
                        @csrf
                        <div class="form-group d-flex justify-content-between">
                            <label>Data Produk</label>
                            <input type="hidden" name="id_pembelian" id="id_pembelian" value="{{ $id_pembelian }}">
                            <input type="hidden" name="id_produk" id="id_produk">
                            <input type="hidden" class="form-control" name="kode_produk" id="kode_produk">

                            <button onclick="tampilProduk()" class="btn btn-info btn-sm" type="button"><i
                                    class="bi bi-plus"></i></button>

                        </div>
                        {{-- <div class="form-group row">
                            <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input type="hidden" name="id_pembelian" id="id_pembelian" value="{{ $id_pembelian }}">
                                    <input type="hidden" name="id_produk" id="id_produk">
                                    <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                    <span class="input-group-btn">
                                        <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button"><i
                                                class="bi bi-arrow-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div> --}}
                    </form>

                    <table class="table table-stiped table-bordered " id="table-pembelian">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th width="15%">Jumlah</th>
                            <th>Subtotal</th>
                            <th width="15%">Aksi</th>
                        </thead>
                    </table>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tampil-bayar bg-primary"></div>
                            <div class="tampil-terbilang"></div>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('pembelian.store') }}" class="form-pembelian" method="post">
                                @csrf
                                <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">

                                <div class="form-group row">
                                    <label for="totalrp" class="col-lg-4 control-label">Total</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="totalrp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-4 control-label">Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="number" name="diskon" id="diskon" class="form-control"
                                            value="{{ $diskon }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar" class="col-lg-4 control-label">Bayar</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="bayarrp" class="form-control">
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <div class="col-lg-4"></div>
                                    <div class="form-check col-lg-8">
                                    <div class=" checkbox">
                                        <input type="checkbox" id="lunas" class="form-check-input">
                                        <label for="lunas">Dibayar</label>
                                    </div>
                                </div>
                                </div> --}}

                            </form>
                            <div class="">
                                <button type="submit"
                                    class="btn btn-primary btn-sm btn-flat pull-right btn-simpan col-12"><i
                                        class="fa fa-floppy-o"></i> Simpan Transaksi</button>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>

    </section>
    @includeIf('pembelian_detail.produk')


@endsection

@push('scripts')
    <script>
        let table, table2;

        $(function() {
            $('body').addClass('sidebar-collapse');

            table = $('#table-pembelian').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('pembelian_detail.data', $id_pembelian) }}',
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            searchable: false,
                            sortable: false
                        },
                        {
                            data: 'kode_produk'
                        },
                        {
                            data: 'nama_produk'
                        },
                        {
                            data: 'harga_beli'
                        },
                        {
                            data: 'jumlah'
                        },
                        {
                            data: 'subtotal'
                        },
                        {
                            data: 'aksi',
                            searchable: false,
                            sortable: false
                        },
                    ],
                    dom: 'Brt',
                    bSort: false,
                    paginate: false
                })
                .on('draw.dt', function() {
                    loadForm($('#diskon').val());
                });
            table2 = $('.table-produk').DataTable();

            $(document).on('input', '.quantity', function() {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                // if (jumlah < 1) {
                //     $(this).val(1);
                //     alert('Jumlah tidak boleh kurang dari 1');
                //     return;
                // }
                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('Jumlah tidak boleh lebih dari 10000');
                    return;
                }

                $.post(`{{ url('/pembelian_detail') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah
                    })
                    .done(response => {
                        $(this).on('mouseout', function() {
                            table.ajax.reload(() => loadForm($('#diskon').val()));
                        });
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });

            $(document).on('input', '#diskon', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($(this).val());
            });

            $('.btn-simpan').on('click', function() {
                $('.form-pembelian').submit();
            });
        });

        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function hideProduk() {
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            hideProduk();
            tambahProduk();
        }

        function tambahProduk() {
            $.post('{{ route('pembelian_detail.store') }}', $('.form-produk').serialize())
                .done(response => {
                    $('#kode_produk').focus();
                    table.ajax.reload(() => loadForm($('#diskon').val()));
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload(() => loadForm($('#diskon').val()));
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }

        function loadForm(diskon = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/pembelian_detail/loadform') }}/${diskon}/${$('.total').text()}`)
                .done(response => {
                    $('#totalrp').val('Rp. ' + response.totalrp);
                    $('#bayarrp').val('Rp. ' + response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text(response.terbilang);
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function checkValue(input) {
            var newValue = parseInt(input.value);
            var feedbackDiv = document.getElementById('feedback');

            if (newValue < 0) {
                input.value = 0; // Jika jumlah melebihi stok, ubah nilainya menjadi stok maksimum
                feedbackDiv.className = 'invalid-feedback';
                input.className = 'form-control input-sm quantity is-invalid';
                // Menambahkan teks pesan pada div "feedback"
                feedbackDiv.innerHTML = 'Jumlah tidak boleh kurang dari 0';

            } else {
                // Jika jumlah valid, hapus class "invalid" dan teks pesan pada div "feedback"
                feedbackDiv.className = '';
                feedbackDiv.innerHTML = '';
            }
        }
    </script>
@endpush
