<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        {{
        Request::is('dashboard') ? 'Dashboard' :
        (Request::is('menu') ? 'Data Menu' :
        (Request::is('menu/create') ? 'Tambah Menu Baru' :
        (Request::is('menu/*/edit') ? 'Edit Data Menu' :
        (Request::is('penjualan') ? 'Data Penjualan' :
        (Request::is('penjualan/create') ? 'Tambah Data Penjualan' :
        (Request::is('penjualan/*/edit') ? 'Edit Data Penjualan' :
        (Request::is('pembelian') ? 'Data Pembelian' :
        (Request::is('pembelian/create') ? 'Tambah Data Pembelian' :
        (Request::is('pembelian/*/edit') ? 'Edit Data Pembelian' :
        (Request::is('biaya-lain') ? 'Data Biaya Lain-lain' :
        (Request::is('biaya-lain/create') ? 'Tambah Data Biaya Lain-lain' :
        (Request::is('biaya-lain/*/edit') ? 'Edit Data Biaya Lain-lain' :
        (Request::is('laba-rugi') ? 'Laporan Laba Rugi' :
        (Request::is('supplier') ? 'Data Supplier' :
        (Request::is('supplier/create') ? 'Tambah Data Supplier' :
        (Request::is('supplier/*/edit') ? 'Edit Data Supplier' :
        (Request::is('pelanggan') ? 'Data Pelanggan' :
        (Request::is('pelanggan/create') ? 'Tambah Data Pelanggan' :
        (Request::is('pelanggan/*/edit') ? 'Edit Data Pelanggan' :
        (Request::is('profile') ? 'Profile' :

        (Request::is('user/create') ? 'Add New employee' :
        (Request::is('account') ? 'My Account' :
        (Request::is('user/*/edit') ? 'Edit employee' :
        (Request::is('user/edit/*') ? 'Edit Profile' :
        (Request::is('user/*') ? 'My Profile' :
        'appantuh'
        )))))))))))))))))))))))))
        }}
    </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/logo_warung_small.ico">

    <!-- FontAwesome JS-->
    <script defer src="/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link rel="stylesheet" href="/css/portal.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/fontawesome-free-6.2.1-web/css/all.css">

    {{-- trix --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.umd.min.js"></script>

    <!-- Select Table -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

    <!-- Sweetalert -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <style>
        /* trix css  */
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        trix-toolbar [data-trix-button-group="text-tools"] button[title="Link"] {
            display: none;
        }

        trix-toolbar [data-trix-button-group="block-tools"] button[title="Code"] {
            display: none;
        }

        trix-editor {
            background-color: #fff;
        }
    </style>

</head>

<body class="app">
    <header class="app-header fixed-top">
        @include('layouts.header')
        @include('layouts.sidebar')
    </header>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-4 mb-4 ">
                    @yield('container')
                </div>
                @yield('section')
            </div>
        </div>
    </div>

    <script src="/plugins/popper.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/password.js"></script>
</body>

<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Apakah kamu yakin ingin menghapus data ini?",
                text: "Jika dihapus, data akan hilang permanen.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel","Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
</script>

<script>
    $(function(){
    @if(Session::has('success'))
        Swal.fire({
        icon: 'success',
        text: '{{ Session::get("success") }}'
    })
    @endif
});
</script>

</html>