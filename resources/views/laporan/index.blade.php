@extends('layouts.app')

@section('title', 'Laporan')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
@endpush
@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Laporan Transaksi</h4>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-primary" title="Ubah Periode" onclick="updatePeriode()"><i
                                        class="bi bi-calendar-date"></i> Ubah Periode</a>
                                <a class="btn btn-sm btn-secondary" title="Export Pdf" href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank"><i class="bi bi-file-text"></i>
                                    Export PDF</a>
                                    
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
                            <table class="table table-striped table-responsive" id="table-laporan">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Penjualan</th>
                                        <th>Pembelian</th>
                                        <th>Pengeluaran</th>
                                        <th>Pendapatan</th>
                                        
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @includeIf('laporan.form')
    </section>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
let table;

$(function () {
    table = $('#table-laporan').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        "scrollX": true, 
        ajax: {
            url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
        },
        columns: [
            
            {data: 'tanggal'},
            {data: 'penjualan'},
            {data: 'pembelian'},
            {data: 'pengeluaran'},
            {data: 'pendapatan'}
        ],
        dom: 'Brt',
        bSort: false,
        bPaginate: false,
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
});

function updatePeriode() {
    $('#modal-form').modal('show');
}
    </script>
@endpush
