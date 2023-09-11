@extends('layouts.app')

@section('title', 'Penjualan')

@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            {{-- <h4>Data Penjualan</h4> --}}
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible show fade">
                                Transaksi Selesai
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                @if ($setting->tipe_nota == 1)
                                <button type="" class="btn btn-primary me-1 mb-1" onclick="notaKecil('{{ route('transaksi.nota_kecil') }}', 'Nota Kecil')">
                                  Cetak Nota k
                                </button>
                                @else
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1" onclick="notaBesar('{{ route('transaksi.nota_besar') }}', 'Nota PDF')">
                                  Cetak Nota B
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<script>
    // tambahkan untuk delete cookie innerHeight terlebih dahulu
    document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    
    function notaKecil(url, title) {
        popupCenter(url, title, 625, 500);
    }

    function notaBesar(url, title) {
        popupCenter(url, title, 900, 675);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
        const dualScreenTop  = window.screenTop  !==  undefined ? window.screenTop  : window.screenY;

        const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left       = (width - w) / 2 / systemZoom + dualScreenLeft
        const top        = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow  = window.open(url, title, 
        `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
        );

        if (window.focus) newWindow.focus();
    }
</script>
@endpush