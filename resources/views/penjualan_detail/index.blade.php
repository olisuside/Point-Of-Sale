@extends('layouts.app')

@section('title', 'Penjualan')

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

        #table-penjualan tbody tr:last-child {
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

            <div class="card">
                <div class="card-body">
                    <form class="form-produk">
                        @csrf
                        <div class="form-group d-flex justify-content-between">
                            <label>Data Produk</label>
                            <input type="hidden" name="id_penjualan" id="id_penjualan" value="{{ $id_penjualan }}">
                            <input type="hidden" name="id_produk" id="id_produk">
                            <input type="hidden" class="form-control" name="kode_produk" id="kode_produk">
                            <button onclick="tampilProduk()" class="btn btn-info btn-sm" type="button"><i
                                class="bi bi-plus"></i></button>
                        </div>
                        
                        {{-- <div class="form-group row">
                            <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input type="hidden" name="id_penjualan" id="id_penjualan" value="{{ $id_penjualan }}">
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

                    <table class="table table-stiped table-bordered " id="table-penjualan">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th width="15%">Jumlah</th>
                            <th>Diskon</th>
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
                            <form action="{{ route('transaksi.simpan') }}" class="form-penjualan" method="post">
                                @csrf
                                <input type="hidden" name="id_penjualan" value="{{ $id_penjualan }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">
                                <input type="hidden" name="id_member" id="id_member"
                                    value="{{ $memberSelected->id_member }}">

                                <div class="form-group row">
                                    <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="totalrp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kode_member" class="col-lg-2 control-label">Member</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="kode_member"
                                                value="{{ $memberSelected->kode_member }}" required>
                                            <span class="input-group-btn">
                                                <button onclick="tampilMember()" class="btn btn-info btn-flat"
                                                    type="button"><i class="bi bi-arrow-right"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="number" name="diskon" id="diskon" class="form-control"
                                            value="{{ !empty($memberSelected->id_member) ? $diskon : 0 }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar" class="col-lg-2 control-label">Bayar</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="bayarrp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row " id="diterima-input">
                                    <label for="diterima" class="col-lg-2 control-label">Diterima</label>
                                    <div class="col-lg-8 ">
                                        <div class="input-group">

                                            <span class="input-group-text" id="">Rp. </span>
                                            <input type="number" id="diterima" class="form-control" name="diterima"
                                            value="{{ $penjualan->diterima ?? 0 }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="kembali-input">
                                    <label for="kembali" class="col-lg-2 control-label">Kembali</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="kembali" name="kembali" class="form-control"
                                            value="0" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="btn-group">
                                        <input type="radio" class="btn-check" name="options-outlined" id="primary-outlined"
                                        autocomplete="off" checked>
                                        <label class="btn btn-outline-primary" for="primary-outlined">Cash</label>
                                        
                                        <input type="radio" class="btn-check" name="options-outlined" id="second-outlined"
                                        autocomplete="off">
                                        <label class="btn btn-outline-primary" for="second-outlined">Cashless</label>
                                    </div>
                                </div>
                            
                            <div class="">
                                <button type="submit"
                                    class="btn btn-primary btn-sm btn-flat pull-right btn-simpan col-12"><i
                                        class="fa fa-floppy-o"></i> Simpan Transaksi</button>
                            </div>
                            <div class="">
                                <button type="submit"
                                    class="btn btn-primary btn-sm btn-flat pull-right btn-payment col-12"><i
                                        class="fa fa-floppy-o"></i> Simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>

                </div>



            </div>
        </div>
        @includeIf('penjualan_detail.produk')
        @includeIf('penjualan_detail.member')
    </section>


@endsection

@push('scripts')
    <script>
        let table, table2;

        $(function() {
            $('body').addClass('sidebar-collapse');

            table = $('#table-penjualan').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('transaksi.data', $id_penjualan) }}',
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
                            data: 'harga_jual'
                        },
                        {
                            data: 'jumlah'
                        },
                        {
                            data: 'diskon'
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
                    setTimeout(() => {
                        $('#diterima').trigger('input');
                    }, 300);
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

                $.post(`{{ url('/transaksi') }}/${id}`, {
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

            $('#diterima').on('input', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($('#diskon').val(), $(this).val());
            }).focus(function() {
                $(this).select();
            });

            $('.btn-simpan').on('click', function() {
                $('.form-penjualan').submit();
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
            $.post('{{ route('transaksi.store') }}', $('.form-produk').serialize())
                .done(response => {
                    $('#kode_produk').focus();
                    table.ajax.reload(() => loadForm($('#diskon').val()));
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }

        function tampilMember() {
            $('#modal-member').modal('show');
        }

        function pilihMember(id, kode) {
            $('#id_member').val(id);
            $('#kode_member').val(kode);
            $('#diskon').val('{{ $diskon }}');
            loadForm($('#diskon').val());
            $('#diterima').val(0).focus().select();
            hideMember();
        }

        function hideMember() {
            $('#modal-member').modal('hide');
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

        function loadForm(diskon = 0, diterima = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/transaksi/loadform') }}/${diskon}/${$('.total').text()}/${diterima}`)
                .done(response => {
                    
                    $('#totalrp').val('Rp. ' + response.totalrp);
                    $('#bayarrp').val('Rp. ' + response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Bayar: Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text(response.terbilang);

                    $('#kembali').val('Rp.' + response.kembalirp);

                    if (response.kembalirp < 0 || $('#diterima').val() <= 0) {
                        $('.btn-simpan').prop('disabled', true);
                    } else {
                        $('.btn-simpan').prop('disabled', false);
                        $('.tampil-bayar').text('Kembali: Rp. ' + response.kembalirp);
                        $('.tampil-terbilang').text(response.kembali_terbilang);
                    }

                    // if ($('#diterima').val() != 0) {
                    //     $('.tampil-bayar').text('Kembali: Rp. ' + response.kembalirp);
                    //     $('.tampil-terbilang').text(response.kembali_terbilang);
                    // }
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function checkValue(input) {
            var maxStock = parseInt(input.getAttribute('max'));
            var newValue = parseInt(input.value);
            var feedbackDiv = document.getElementById('feedback');

            if (newValue > maxStock) {
                input.value = maxStock; // Jika jumlah melebihi stok, ubah nilainya menjadi stok maksimum
                feedbackDiv.className = 'invalid-feedback';
                input.className = 'form-control input-sm quantity is-invalid';
                // Menambahkan teks pesan pada div "feedback"
                feedbackDiv.innerHTML = 'Jumlah melebihi stok produk. Sisa stok = ' + maxStock;

            } else if (newValue < 0) {
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

<script>
    // Fungsi untuk mengubah nilai atribut action pada form
    function updateFormAction() {
        var form = document.querySelector('.form-penjualan');
        var cashRadio = document.getElementById('primary-outlined');
        var cashlessRadio = document.getElementById('second-outlined');
        var diterimaInput = document.getElementById('diterima-input');
        var kembaliInput = document.getElementById('kembali-input');
        var btnsimpan = document.querySelector('.btn-simpan');
        var btnpayment = document.querySelector('.btn-payment');

        if (cashRadio.checked) {
            form.action = "{{ route('transaksi.simpan') }}";
            // Tampilkan kembali dan diterima
            diterimaInput.style.display = '';
            kembaliInput.style.display = '';
            btnpayment.style.display = 'none';
            btnsimpan.style.display = '';
        } else if (cashlessRadio.checked) {
            form.action = "{{ route('transaksi.save') }}";
            // Sembunyikan kembali dan diterima
            diterimaInput.style.display = 'none';
            kembaliInput.style.display = 'none';
            btnsimpan.style.display = 'none';
            btnpayment.style.display = '';
        }
    }

    // Fungsi untuk menginisialisasi event listener dan pemanggilan awal
    function initializeFormAction() {
        var cashRadio = document.getElementById('primary-outlined');
        var cashlessRadio = document.getElementById('second-outlined');

        cashRadio.addEventListener('change', updateFormAction);
        cashlessRadio.addEventListener('change', updateFormAction);

        // Panggil fungsi pertama kali saat halaman dimuat
        updateFormAction();
    }

    // Panggil fungsi inisialisasi saat halaman dimuat
    window.onload = initializeFormAction;
</script>


@endpush
