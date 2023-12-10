<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('assets/loginregis/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/loginregis/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/loginregis/css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/images/logo_warung_small.ico') }}" type="image/ico" />

    <title>@yield('title') - Warung Makan Tung-Tung</title>
</head>

<body>
    <section class="form-02-main">
        @yield('content')
    </section>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script>
        $(".show-hide").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
    </script>
</body>

</html>