@extends('layouts.app')

@section('title', 'Kategori')

@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Data Kategori</h4>
                            <a class="btn btn-sm btn-primary" title="Tambah Kategori" onclick="addForm()"><i
                                    class="bi bi-plus"></i></a>
                        </div>

                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <table class="table table-striped" id="table2">
                                <thead>
                                    <tr>
                                        <th class="col-2">No</th>
                                        <th class="col-10">Nama Kategori</th>
                                        <th class="col-2">Aksi</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @includeIf('kategori.form')
    </section>

@endsection

@push('scripts')
    <script>
        // let jquery_datatable = $("#table2").DataTable({
        //     processing : true,
        //     autoWidth : true,
        //     ajax: {
        //             url: '{{ route('kategori.data') }}',
        //         },
        //         columns: [
        //             {data: 'DT_RowIndex', searchable: false, sortable: false},
        //             {data: 'nama_kategori'},
        //             {data: 'aksi', searchable: false, sortable: false},
        //         ]
        // });


        let able;

        $(function() {
            table = $('#table2').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('kategori.data') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'nama_kategori'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menyimpan data');
                            return;
                        });
                }
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Kategori');
            $('#modal-form .submit-text').text('Tambah');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama_kategori]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Kategori');
            $('#modal-form .submit-text').text('Edit');


            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_kategori]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_kategori]').val(response.nama_kategori);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
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
