@extends('layouts.app')

@section('title', 'Penjualan')

@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Data Penjualan</h4>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <table class="table table-striped table-responsive" id="table-penjualan">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kode Member</th>
                                        <th>Total Item</th>
                                        <th>Total Harga</th>
                                        <th>Diskon</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                        <th>Kasir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        @include('penjualan.detail')
    </section>
@endsection

@push('scripts')
    <script>
        let table, table1;

        $(function() {
            table = $('#table-penjualan').DataTable({
                responsive: false,
                processing: true,
                serverSide: true,
                autoWidth: false,
                "scrollX": true, 
                ajax: {
                    url: '{{ route('penjualan.data') }}',
                },
                columns: [{
                        data: 'tanggal',
                        sortable: false
                    },
                    {
                        data: 'kode_member'
                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'bayar'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'kasir'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            table1 = $('#table-detail').DataTable({
                processing: true,
                bSort: false,
                dom: 'Brt',
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
                        data: 'subtotal'
                    },
                ]
            })
        });

        function showDetail(url) {
            $('#modal-detail').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }
    </script>
@endpush
