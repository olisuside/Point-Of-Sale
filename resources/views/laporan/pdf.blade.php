<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}"> --}}

    <style>
        table {
        margin: 0 auto;
    }
        table td {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 14px;
        }
        table.data td,
        table.data th {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table.data {
            border-collapse: collapse;
            justify-content: center; 
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h3 class="text-center">Laporan Pendapatan</h3>
    <h4 class="text-center">
        Tanggal {{ tanggal_indonesia($awal, false) }}
        s/d
        Tanggal {{ tanggal_indonesia($akhir, false) }}
    </h4>

    <table class="data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Penjualan</th>
                <th>Pembelian</th>
                <th>Pengeluaran</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $col)
                        <td>{{ $col }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script> --}}
</body>
</html>
