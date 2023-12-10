<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/logo_warung_small.ico">
    <title>Laporan Penjualan</title>

    <!-- FontAwesome JS-->
    <script defer src="/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link rel="stylesheet" href="/css/portal.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/fontawesome-free-6.2.1-web/css/all.css">
</head>

<body>
    <div class="container">
        <div class="row my-5 d-flex flex-column justify-content-between">
            <div class="col d-flex flex-column align-items-center">
                <img src="/assets/images/logo_warung.png" class="mb-3" alt="" srcset="" width="60">
                <h2>WARUNG MAKAN TUNG-TUNG</h2>
                <p class="mb-1">Jln. Mrican Baru No.27A, Depok, Sleman, Yogyakarta.</p>
            </div>
            <hr class="mt-3" style="border: 2px solid black;">
            <div class="col my-5">
                <h3 class="text-center">Transaction Report</h3>
                <p class="mb-0 text-center">{{ isset($_GET['month']) && isset($_GET['year']) ? 'Data penjualan pada
                    '.strftime('%B', mktime(0, 0, 0, $_GET['month'], 1)).' '.$_GET["year"] : (isset($_GET['month']) ?
                    'Data penjualan pada '.strftime('%B', mktime(0, 0, 0, $_GET['month'], 1)) : (isset($_GET['year']) ?
                    'Data penjualan pada '.$_GET["year"] : (isset($_GET["data"]) && $_GET["data"] == 'all' ? 'Data
                    penjualan keseluruhan' : (isset($_GET["data"]) && $_GET["data"] == 'today' ? 'Data penjualan hari
                    ini' : (isset($_GET["data"]) && $_GET["data"] == 'thisMonth' ? 'Data penjualan bulan ini' : 'bau'
                    ))))) }}
                </p>
            </div>
        </div>
        <table class="table my-5">
            <thead>
                <tr>
                    <th scope="col">Tanggal Jual</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td scope="row"><strong>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM
                            YYYY')}}</strong></td>
                    {{-- <td scope="row"><strong>{{ $item->created_at->format('d M Y') }}</strong></td> --}}
                    <td>
                        @foreach ($item->transaction_details as $el)
                        <div class="row border-bottom border-dark">
                            {{ $el->menu->nama }}
                        </div>
                        @endforeach
                    </td>
                    <td>@foreach ($item->transaction_details as $el)
                        <div class="row justify-content:center; border-bottom border-dark">
                            {{ $el->jumlah }}
                        </div>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item->transaction_details as $el)
                        <div class="row border-bottom border-dark">
                            Rp {{ number_format($el->menu->harga, 0, ',', '.')}}
                        </div>
                        @endforeach
                    </td>
                    <td>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                @php
                $arr_total = [];

                foreach($data as $item) {
                $arr_total[] = $item->total_harga;
                };

                $total_penjualan = array_sum($arr_total);
                @endphp
                <tr>
                    <td colspan="4" class="text-end"><strong>Total Penjualan</strong></td>
                    <td><strong>Rp. {{ number_format($total_penjualan, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="float-end">
        <p>
            Yogyakarta, {{$today}}
            <br>Pemilik
            <br><br><br>
            <b>Didik Hartanto</b>
        </p>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>