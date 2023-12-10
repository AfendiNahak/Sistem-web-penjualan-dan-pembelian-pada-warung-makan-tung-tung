<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Home - Warung Makan Tung-Tung</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/images/logo_warung_small.ico') }}" type="image/ico" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landingpage/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/landingpage/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <h1>WatungMakan<br>TungTung</h1>
            </a>

            <!-- Nav Menu -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            <!-- End Nav Menu -->

            @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-light">Dashboard</a>
                @else
                <a href="{{ route('login') }}" type="button" class="btn btn-light" style="cursor: pointer">Login</a>

                @if (Route::has('register'))
                <a class="btn btn-info" href="{{ route('register') }}">Register</a>

                @endif
                @endauth
            </div>
            @endif

        </div>
    </header><!-- End Header -->

    <main id="main">
        <!-- Hero Section - Home Page -->
        <section id="hero" class="hero">
            <img src="{{ asset('assets/images/wm_tungtung.jpg') }}" alt="" data-aos="fade-in">
            <div class="container">
                <div class="row justify-content-center" data-aos-delay="100">
                    <div class="col-xl-10">
                        <div class="text-center">
                            <h2 data-aos="fade-up" data-aos-delay="100">Selamat Datang di Website Pengolahan Data
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="200">Website ini mencatat data penjualan dan pembelian
                                Warung Makan Tung-Tung
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/landingpage/js/main.js') }}"></script>

</body>

</html>