@extends('layouts.order')

@section('container')
<div class="row justify-content-center align-items-center">
    <div class="col-xl-12">
        <div class="row justify-content-around">

            <div class="col-md-5">
                <div class="card border-0 ">
                    <div class="card-header card-2">
                        <p class="card-text text-muted mt-md-4  mb-2 space">DAFTAR PESANAN</p>
                        <hr class="my-2">
                    </div>
                    <div class="card-body pt-0">
                        <div style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
                            @foreach ($data as $key)
                            @foreach ($key->transaction_details as $item)
                            <div class="row  justify-content-between mb-3 pe-2">
                                <div class="col-auto col-md-7">
                                    <div class="media flex-column flex-sm-row">
                                        <div class="media-body  my-auto">
                                            <div class="row ">
                                                <div class="col-auto">
                                                    <p class="mb-0"><b>{{ $item->menu->nama }}</b></p><small
                                                        class="text-muted">{{ $item->menu->kategori }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" pl-0 flex-sm-col col-auto  my-auto">
                                    <p class="boxed-1">{{ $item->jumlah }}</p>
                                </div>
                                <div class=" pl-0 flex-sm-col col-auto  my-auto ">
                                    <p><b>Rp {{ number_format($item->harga, 0, ',', '.') }}</b></p>
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                        <hr class="my-2">
                        @foreach ($data as $key)
                        <div class="row">
                            <div class="col">
                                <div class="row justify-content-between mb-2">
                                    <div class="col-3">
                                        <p><b>Total</b></p>
                                    </div>
                                    <div class="flex-sm-col col-auto">
                                        <p class="mb-1"><b>Rp {{ number_format($key->total_harga, 0, ',', '.')
                                                }}</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card border-0">
                    <div class="card-header pb-0">
                        <h2 class="card-title space ">Pembayaran</h2>
                        <p class="card-text text-muted mt-4  space">DETAIL PEMBAYARAN</p>
                        <hr class="my-0">
                    </div>
                    @foreach($data as $key)
                    @if($key->status == 'paid')
                    <div class="card-body">
                        <input type="hidden" name="id" id="id_transaction" value="{{ $key->id }}">
                        <div class="form-group mb-3">
                            <label for="total_harga" class="small text-muted fw-semibold mb-1">TOTAL
                                HARGA</label>
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" disabled name="total_harga"
                                        id="total_harga" value="{{ number_format($key->total_harga, 0, ',', '.') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="total_bayar" class="small text-muted fw-semibold mb-1">TOTAL BAYAR</label>
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" name="total_bayar"
                                        value="{{ number_format($key->total_bayar, 0, ',', '.') }}" id="harga" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-md-5 mt-4">
                            <div class="col">
                                <a onclick="show_my_receipt1()" class="text-white btn btn-info w-100 btn-block ">Cetak
                                    Nota</a>
                            </div>
                        </div>
                    </div>

                    @else
                    <form action="/penjualan/{{ $key->id }}" method="POST" class="card-body">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" id="id_transaction" value="{{ $key->id }}">
                        <div class="form-group mb-3">
                            <label for="total_harga" class="small text-muted fw-semibold mb-1">TOTAL HARGA</label>
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" disabled name="total_harga"
                                        id="total_harga" value="{{ number_format($key->total_harga, 0, ',', '.') }}">
                                    <input type="hidden" id="total" name="total_harga" value="{{ $key->total_harga }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="total_bayar" class="small text-muted fw-semibold mb-1">TOTAL BAYAR</label>
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-sm total_bayar @error('total_bayar') is-invalid @enderror"
                                        id="harga">
                                    <input type="hidden" name="total_bayar" id="total_bayar">
                                    @error('total_bayar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-md-5 mt-4">
                            <div class="col">
                                <button type="submit" onclick="show_my_receipt2()"
                                    class="text-white btn btn-primary w-100 btn-block ">BAYAR Rp. {{
                                    number_format($key->total_harga, 0, ',', '.') }}</button>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    const total_paymentFormat = document.querySelector('.total_bayar');
    const total_paymentInput = document.getElementById('total_bayar');

    total_paymentFormat.addEventListener('keyup', function() {
        total_paymentInput.value = parseInt(this.value.replace('.', ''));
    })

    function show_my_receipt1() {
        var page = '/invoice/'+ document.getElementById('id_transaction').value;
        var total_payment = document.getElementById("harga");
        if (!total_payment.value) {
            return false;
        } else {
            localStorage.setItem('payment', total_payment.value)
            var myWindow = window.open(page, "_blank");
            myWindow.focus();
        }
    }

    function show_my_receipt2() {
        var page = '/invoice/'+ document.getElementById('id_transaction').value;
        var total_payment = parseInt(document.getElementById("harga").value.replace('.',''));
        var total_transaction = parseInt(document.getElementById("total").value);
        if (total_payment < total_transaction) {
            return false;
        } else {
            localStorage.setItem('payment', document.getElementById("harga").value)
            var myWindow = window.open(page, "_blank");
            myWindow.focus();
        }
    }
</script>
<script src="/js/formatmoney.js"></script>
@endsection