<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/logo_warung_small.ico">
    <title>Nota Penjualan</title>

    <!-- FontAwesome JS-->
    <script defer src="/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link rel="stylesheet" href="/css/portal.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/fontawesome-free-6.2.1-web/css/all.css">
</head>

<body>
    <div class="card">
        <div class="card-body mx-4">
            <div class="container">
                <p class="my-5 mb-0 text-center" style="font-size: 30px;">WARUNG MAKAN TUNG-TUNG</p>
                <p class="mt-0 mb-1 text-center" style="font-size: 15px;">Jln. Mrican Baru No.27A, Depok, Sleman,
                    Yogyakarta</p><br>
                @foreach ($data as $key)
                <div class="row">
                    <ul class="list-unstyled">
                        <li class="text-black mt-1">Tanggal &nbsp : &nbsp {{$key->created_at->format('d M Y')}}</li>
                    </ul>
                    <hr>
                    @foreach ($key->transaction_details as $item)
                    <div class="col-xl-10">
                        <p class="mb-0">{{ $item->menu->nama }}</p>
                        <p class="small text-muted">{{ $item->jumlah }} x {{ $item->menu->harga }}</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                    <hr>
                    @endforeach
                </div>
                <div class="row text-black">
                    <div class="col-xl-12">
                        <p class="float-end fw-bold">Total &nbsp: &nbsp Rp. {{ number_format($key->total_harga,
                            0,',','.') }}</p>
                    </div>
                    <hr style="border: 2px solid black;">
                </div>
                <h2 class="float-end total-payment">Rp. {{ number_format($key->total_bayar, 0, ',', '.') }}</h2>
                @endforeach
                <div class="text-center" style="margin-top: 90px;">
                    <p class="mb-0 d-flex align-items-center justify-content-center"><u
                            class="text-info text-decoration-none"><img src="/assets/images/logo_warung_small.ico"
                                alt="" srcset="" width="20"> &nbsp Warung Makan Tung-Tung</u></p>
                    <p>Terima kasih sudah berkunjung ke warung kami. </p>
                </div>

            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
    <script>
        window.onload = function () {
            let totalPayment = document.querySelector('.total-payment');

            if (totalPayment.innerText == '0') {
                totalPayment.innerText = localStorage.getItem('payment');
            } else {
                localStorage.clear();
                return false;
            }

            window.print();
        }
    </script>
</body>

</html>