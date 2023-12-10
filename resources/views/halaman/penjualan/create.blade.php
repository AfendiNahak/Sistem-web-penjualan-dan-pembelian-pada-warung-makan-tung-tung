@extends('layouts.order')

@section('container')

<div class="col-md-8 p-0 h-100 flex flex-column justify-content-between">
    <div class="hd-menu d-flex align-items-center justify-content-between shadow bg-white">
        <div class="col-sm-5 d-flex align-items-center">
            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"
                        d="M4 7h22M4 15h22M4 23h22"></path>
                </svg>
            </a>
            <h5 class="fs-5 fw-bold text-black ms-4">Semua Menu</h5>
        </div>
    </div>
    <div class="wp-menu d-flex flex-column">
        <div class="menu-tr mt-3 mb-3">
            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#makanan">
                        <h4>Makanan</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#minuman">
                        <h4>Minuman</h4>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content menu-tab overflow-auto" style="height: 85%" data-aos="fade-up" data-aos-delay="300">
            <div class="tab-pane fade active show" id="makanan">
                <div class="menu-content pe-4 ps-4 d-flex flex-wrap justify-content-between">
                    @foreach ($makanans as $makanan)
                    <div class="menu-item-cart rounded shadow d-flex align-items-center justify-content-around"
                        data-id="{{ $makanan->id }}" style="margin-bottom: 7%; width: 250px;">
                        <img class="img-fluid" src="{{ asset('storage/' . $makanan->foto) }}" alt="" srcset=""
                            style="border-radius: 50%;width: 120px;">
                        <div class="d-flex justify-content-center flex-column">
                            <div class="product">
                                <h5 style="font-size: 16px; width: 100px;" class="text-break">{{ $makanan->nama }}</h5>
                                {{-- <span>Rp</span> --}}
                                <h6 style="font-size: 13px;">{{ number_format($makanan->harga, 0, ',', '.') }}</h6>
                            </div>
                            <div class="qty d-flex mt-3">
                                <button class="border-0 rounded bg-transparent RemovetoCart"><i
                                        class="fa-solid fa-minus" style="font-size: 12px;"></i></button>
                                <div class="qty-numbers me-3 ms-3">
                                    0
                                </div>
                                <button class="border-0 rounded bg-transparent AddtoCart"><i class="fa-solid fa-plus"
                                        style="font-size: 12px;"></i></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="minuman">
                <div class="menu-content pe-4 ps-4 d-flex flex-wrap justify-content-between">
                    @foreach ($minumans as $minuman)
                    <div class="menu-item-cart rounded shadow d-flex align-items-center justify-content-around"
                        data-id="{{ $minuman->id }}" style="margin-bottom: 7%; width: 250px;">
                        <img class="img-fluid" src="{{ asset('storage/' . $minuman->foto) }}" alt="" srcset=""
                            style="border-radius: 50%;width: 120px;">
                        <div class="d-flex justify-content-center flex-column">
                            <div class="product">
                                <h5 style="font-size: 16px; width: 100px;" class="text-break">{{ $minuman->nama }}</h5>
                                <h6 style="font-size: 13px;">{{ number_format($minuman->harga, 0, ',', '.') }}</h6>
                            </div>
                            <div class="qty d-flex mt-3">
                                <button class="border-0 rounded bg-transparent RemovetoCart"><i
                                        class="fa-solid fa-minus" style="font-size: 12px;"></i></button>
                                <div class="qty-numbers me-3 ms-3">
                                    0
                                </div>
                                <button class="border-0 rounded bg-transparent AddtoCart"><i class="fa-solid fa-plus"
                                        style="font-size: 12px;"></i></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 h-100 p-0 d-flex flex-column">
    <div class="cart-title d-flex justify-content-between align-items-center p-4 shadow-sm">
        <h5 class="text-white">Menu Pesanan</h5>
    </div>
    <div class="cart-body d-flex flex-column justify-content-between" style="height: 780px;">
        <div class="d-flex justify-content-between p-3 align-items-center">
            <h6 class="fw-semibold text-white ms-2 tables-selected">Tanggal</h6>
            <h6 class="fw-semibold text-white me-2" style="font-size: 13px;">{{ now()->format('d M Y') }}</h6>
        </div>
        <div class="list-order align-self-center rounded p-4 mb-4" style="height: 280px;">
            <div class="menu-order">

            </div>
        </div>
        <form action="/penjualan" method="POST" class="align-self-center p-0 m-0" style="width: 90%;">
            @csrf
            <input type="hidden" name="menu_id" id="menu_id">
            <div class="cart-payment p-2 d-flex flex-column rounded">
                <div class="subtotal d-flex justify-content-between align-items-center mt-3 p-2 d-none"
                    style="height: 40px;">
                    <h6 class="text-white">Subtotal</h6>
                    <h6 class="sub-total text-white">Rp 0</h6>
                </div>
                <hr class="mt-3 text-white">
                <div class="section-transaction d-flex justify-content-between align-items-center p-2">
                    <h6 class="text-white">Total</h6>
                    <h6 class="total-transaction text-white">Rp 0</h6>
                    <input type="hidden" name="total_harga">
                </div>
            </div>
            <button type="submit"
                class="w-100 cart-order p-3 mt-3 mb-3 rounded text-center border-0 text-dark bg-white">
                Simpan
            </button>
        </form>
    </div>
</div>
<script src="/js/order.js"></script>
<script src="/js/formatmoney.js"></script>
@endsection