@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')

    <div class="row">

        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon green mb-2">
                                <i class="iconly-boldCategory"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Kategori</h6>
                            <h6 class="font-extrabold mb-0">{{ $kategori }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldBag-2"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Produk</h6>
                            <h6 class="font-extrabold mb-0">{{ $produk }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon blue mb-2">
                                <i class="iconly-boldArrow---Down-Square"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Pemasukkan</h6>
                            <h6 class="font-extrabold mb-0">Rp. {{ format_uang($jumlah_penjualan) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon red mb-2">
                                <i class="iconly-boldArrow---Up-Square"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Pengeluaran</h6>
                            <h6 class="font-extrabold mb-0">Rp. {{ format_uang($jumlah_pengeluaran) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Chart --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Line Area Chart</h4>
                </div>
                <div class="card-body">
                    <div id="salesChart"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Chart --}}

@endsection

@push('scripts')
    <!-- ChartJS -->
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        $(function() {
            var options = {
                series: [{
                        name: "Pendapatan",
                        data: {{ json_encode($data_pendapatan) }}
                    },
                    {
                        name: "Penjualan",
                        data: {{ json_encode($data_penjualan) }}
                    },
                    {
                        name: "Pembelian",
                        data: {{ json_encode($data_pembelian) }}
                    },
                ],
                chart: {
                    height: 350,
                    type: "area",
                    toolbar: {
                        show: true,
                        tools: {
                            download: false,
                            selection: false,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan:true,
                        },
                    },
                },
                xaxis: {
                    type: "datetime",
                    categories: <?php echo json_encode($data_tanggal); ?>,
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                tooltip: {
                    x: {
                        format: "dd/MM/yy",
                    },
                },

            };

            var chart = new ApexCharts(document.querySelector("#salesChart"), options);

            // Render the chart
            chart.render();
        });
    </script>
@endpush
