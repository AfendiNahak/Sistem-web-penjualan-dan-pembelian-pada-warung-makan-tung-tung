<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/logo_warung_small.ico">
    <title>Laporan Laba Rugi</title>

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
                <h3 class="text-center">Laporan Laba Rugi</h3>
                <p class="mb-0 text-center">{{ isset($_GET['month']) && isset($_GET['year']) ? 'Data Laba Rugi pada
                    '.strftime('%B', mktime(0, 0, 0, $_GET['month'], 1)).' '.$_GET["year"] : (isset($_GET['month']) ?
                    'Data Laba Rugi pada '.strftime('%B', mktime(0, 0, 0, $_GET['month'], 1)) : (isset($_GET['year']) ?
                    'Data Laba Rugi pada '.$_GET["year"] : (isset($_GET["data"]) && $_GET["data"] == 'all' ? 'Data Laba
                    Rugi keseluruhan' : (isset($_GET["data"]) && $_GET["data"] == 'today' ? 'Data Laba Rugi hari ini' :
                    (isset($_GET["data"]) && $_GET["data"] == 'thisMonth' ? 'Data Laba Rugi bulan ini' : 'bau'
                    ))))) }}
                </p>
            </div>
        </div>
        @php
        $total_pemasukan = [];
        $total_pengeluaran = [];
        $total_biayalain = [];

        foreach($dataPenjualan as $item) {
        $total_pemasukan[] = $item->total_bayar;
        };
        foreach($dataPembelian as $item) {
        $total_pengeluaran[] = $item->total;
        };
        foreach($dataBiayaLain as $item) {
        $total_biayalain[] = $item->total;
        };

        $total_penjualan = array_sum($total_pemasukan);
        $total_pembelian = array_sum($total_pengeluaran);
        $total_biayalainnya = array_sum($total_biayalain);
        $labarugi = $total_penjualan-($total_pembelian+$total_biayalainnya);
        @endphp
        <table class="table my-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th class="cell">Jenis Transaksi</th>
                    <th class="cell">Total Pemasukan</th>
                    <th class="cell">Total Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="cell">1</td>
                    <td class="cell"><b>Penjualan</b></td>
                    <td><strong>Rp. {{ number_format($total_penjualan, 0, ',', '.') }}</strong></td>
                    <td class="cell">-</td>
                </tr>
                <tr>
                    <td class="cell">2</td>
                    <td class="cell"><b>Pembelian</b></td>
                    <td class="cell">-</td>
                    <td><strong>Rp. {{ number_format($total_pembelian, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td class="cell">2</td>
                    <td class="cell"><b>Biaya Lain-lain</b></td>
                    <td class="cell">-</td>
                    <td><strong>Rp. {{ number_format($total_biayalainnya, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end cell">Laba Rugi</th>
                    <td><strong>Rp. {{ number_format($labarugi, 0, ',', '.') }}</strong></td>
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