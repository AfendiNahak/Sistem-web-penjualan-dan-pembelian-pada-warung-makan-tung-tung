<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/logo_warung_small.ico">
    <title>Laporan Biaya Lain-lain</title>

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
                <h3 class="text-center">Laporan Biaya Lain-lain</h3>
                <p class="mb-0 text-center">{{ isset($_GET['month']) && isset($_GET['year']) ? 'Data biaya lain-lain
                    pada '.strftime('%B', mktime(0, 0, 0, $_GET['month'], 1)).' '.$_GET["year"] : (isset($_GET['month'])
                    ?
                    'Data biaya lain-lain pada '.strftime('%B', mktime(0, 0, 0, $_GET['month'], 1)) :
                    (isset($_GET['year']) ?
                    'Data biaya lain-lain pada '.$_GET["year"] : (isset($_GET["data"]) && $_GET["data"] == 'all' ? 'Data
                    biaya lain-lain keseluruhan' : (isset($_GET["data"]) && $_GET["data"] == 'today' ? 'Data biaya
                    lain-lain hari ini' : (isset($_GET["data"]) && $_GET["data"] == 'thisMonth' ? 'Data biaya lain-lain
                    bulan ini' :
                    'bau'
                    ))))) }}
                </p>
            </div>
        </div>
        <table class="table my-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Tgl. Transaksi</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    @php
                    $tt = strtotime($item->tgl_transaksi);
                    @endphp
                    <td scope="row">{{$loop->iteration}}</td>
                    <td scope="row">{{ $item->kode_biayalain }}</td>
                    <td scope="row">
                        {{date('d M Y', $tt)}}
                    </td>
                    <td scope="row">{{ $item->nama }}</td>
                    <td scope="row">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td scope="row">{{ $item->jumlah }}</td>
                    <td scope="row">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                @php
                $arr_total = [];

                foreach($data as $item) {
                $arr_total[] = $item->total;
                };

                $total_harga = array_sum($arr_total);
                @endphp
                <tr>
                    <td colspan="6" class="text-end"><strong>Total Transaksi</strong></td>
                    <td><strong>Rp. {{ number_format($total_harga, 0, ',', '.') }}</strong></td>
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