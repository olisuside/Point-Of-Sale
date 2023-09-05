@extends('layouts.app')

@section('title', 'Member')

@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Data Member</h4>
                            <div class="btn-group">

                                <a class="btn btn-sm btn-primary" title="Tambah Member" onclick="addForm()"><i
                                        class="bi bi-plus"></i></a>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <table class="table table-striped" id="table-member">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@includeIf('member.form')
    </section>
@endsection
@push('scripts')
<script>
    let table;

    $(function() {
                table = $('#table-member').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('member.data') }}',
                    },
                    columns: [
                        {
                            data: 'kode_member'
                        },
                        {
                            data: 'nama'
                        },
                        {
                            data: 'telepon'
                        },
                        {
                            data: 'alamat'
                        },
                        {
                            data: 'aksi',
                            searchable: false,
                            sortable: false
                        },
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
        $('#modal-form .modal-title').text('Tambah Member');
        $('#modal-form .submit-text').text('Tambah');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Member');
        $('#modal-form .submit-text').text('Edit');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=telepon]').val(response.telepon);
                $('#modal-form [name=alamat]').val(response.alamat);
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
