@extends('layouts.main')

@section('container')
<div class="col-auto">
    <h1 class="app-page-title mb-0">Laporan Laba Rugi</h1>
</div>
<div class="col-10">
    <div class="page-utilities">
        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
            <div class="col-auto">
                <form action="/laba-rugi" method="GET" class="table-search-form row gx-1 align-items-center">
                    <div class="col-auto">
                        <select class="form-select w-auto" name="year">
                            @if (!request('year'))
                            <option value="0" selected disabled>Pilih Tahun</option>
                            @else
                            <option value="0" disabled>Pilih Tahun</option>
                            @endif
                            @php
                            $year = date('Y');
                            $min = $year - 8;
                            $max = $year;
                            @endphp
                            @for ( $i=$max; $i>=$min; $i-- )
                            echo '<option value="{{ $i }}" {{ (request('year')==$i) ? 'selected' : ' ' }}>{{ $i }}
                            </option>';
                            @endfor
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select w-auto" name="month">
                            @if (!request('month'))
                            <option value="0" selected disabled>Pilih Bulan</option>
                            @else
                            <option value="0" disabled>Pilih Bulan</option>
                            @endif
                            <option value="01" {{ (request('month')=='01' ) ? 'selected' : ' ' }}> Januari</option>
                            <option value="02" {{ (request('month')=='02' ) ? 'selected' : ' ' }}> Febuari</option>
                            <option value="03" {{ (request('month')=='03' ) ? 'selected' : ' ' }}> Maret</option>
                            <option value="04" {{ (request('month')=='04' ) ? 'selected' : ' ' }}> April</option>
                            <option value="05" {{ (request('month')=='05' ) ? 'selected' : ' ' }}> Mei</option>
                            <option value="06" {{ (request('month')=='06' ) ? 'selected' : ' ' }}> Juni</option>
                            <option value="07" {{ (request('month')=='07' ) ? 'selected' : ' ' }}> Juli</option>
                            <option value="08" {{ (request('month')=='08' ) ? 'selected' : ' ' }}> Augustus</option>
                            <option value="09" {{ (request('month')=='09' ) ? 'selected' : ' ' }}> September</option>
                            <option value="10" {{ (request('month')=='10' ) ? 'selected' : ' ' }}> Oktober</option>
                            <option value="11" {{ (request('month')=='11' ) ? 'selected' : ' ' }}> November</option>
                            <option value="12" {{ (request('month')=='12' ) ? 'selected' : ' ' }}> Desember</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn app-btn-secondary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="col-auto">
                <a class="btn app-btn-primary"
                    href="/laporan-laba-rugi?{{ isset($_GET['month']) && isset($_GET['year']) ? 'month='.$_GET['month'].'&year='.$_GET['year'] : (isset($_GET['month']) ? 'month='.$_GET['month'] : (isset($_GET['year']) ? 'year= '.$_GET['year'] : 'data=all')) }}"
                    formtarget="_blank" id="print"><i class="fa-solid fa-print me-2"></i>Cetak Laporan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('section')
<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link {{ Request::has('month') || Request::has('year') ? ' ' : 'active' }}"
        id="orders-all-tab" data-bs-toggle="tab"
        href="{{ Request::has('month') || Request::has('year') ? ' ' : '#orders-all' }}" role="tab"
        aria-controls="orders-all"
        aria-selected="{{ Request::has('month') || Request::has('year') ? 'false' : 'true' }}">Semua</a>
    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab"
        href="{{ Request::has('month') || Request::has('year') ? ' ' : '#orders-pending' }}" role="tab"
        aria-controls="orders-pending" aria-selected="false">Bulan Ini</a>
</nav>
@php
//variabel laba rugi semua data
$total_pemasukan = [];
$total_pengeluaran = [];
$total_biayalain = [];
//variabel laba rugi perbulan
$total_pemasukan_pb = [];
$total_pengeluaran_pb = [];
$total_biayalain_pb = [];

//load laba rugi semua data
foreach($semuaPenjualan as $item) {
$total_pemasukan[] = $item->total_bayar;
};
foreach($semuaPembelian as $item) {
$total_pengeluaran[] = $item->total;
};
foreach($semuaBiayaLain as $item) {
$total_biayalain[] = $item->total;
};

//load laba rugi perbulan
foreach($penjualanPerBulan as $item) {
$total_pemasukan_pb[] = $item->total_bayar;
};
foreach($pembelianPerBulan as $item) {
$total_pengeluaran_pb[] = $item->total;
};
foreach($biayaLainPerBulan as $item) {
$total_biayalain_pb[] = $item->total;
};

//perhitungan total laba rugi semua data
$total_penjualan = array_sum($total_pemasukan);
$total_pembelian = array_sum($total_pengeluaran);
$total_biayalain = array_sum($total_biayalain);
//perhitungan total laba rugi perbulan
$total_penjualan_pb = array_sum($total_pemasukan_pb);
$total_pembelian_pb = array_sum($total_pengeluaran_pb);
$total_biayalain_pb = array_sum($total_biayalain_pb);

//total laba rugi semua data
$labarugi = $total_penjualan-($total_pembelian+$total_biayalain);
//total laba rugi perbulan
$labarugi_pb = $total_penjualan_pb-($total_pembelian_pb+$total_biayalain_pb);
@endphp

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">No</th>
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
                                <td class="cell">3</td>
                                <td class="cell"><b>Biaya Lain-lain</b></td>
                                <td class="cell">-</td>
                                <td><strong>Rp. {{ number_format($total_biayalain, 0, ',', '.') }}</strong></td>
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
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
        <div class="app-card app-card-orders-table mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">No</th>
                                <th class="cell">Jenis Transaksi</th>
                                <th class="cell">Total Pemasukan</th>
                                <th class="cell">Total Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cell">1</td>
                                <td class="cell">Penjualan</td>
                                <td><strong>Rp. {{ number_format($total_penjualan_pb, 0, ',', '.') }}</strong></td>
                                <td class="cell">-</td>
                            </tr>
                            <tr>
                                <td class="cell">2</td>
                                <td class="cell">Pembelian</td>
                                <td class="cell">-</td>
                                <td><strong>Rp. {{ number_format($total_pembelian_pb, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td class="cell">3</td>
                                <td class="cell"><b>Biaya Lain-lain</b></td>
                                <td class="cell">-</td>
                                <td><strong>Rp. {{ number_format($total_biayalain_pb, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end cell">Laba Rugi</th>
                                <td><strong>Rp. {{ number_format($labarugi_pb, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" style="margin-top: 9%; margin-left: 9%;" data-bs-backdrop="static" data-bs-keyboard="false"
    id="pembelianDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pembelian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="pembelian-body">

            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-3.6.3.min.js"></script>
<script src="/js/show-pembelian.js"></script>
<script>
    const print = document.getElementById('print');
    document.querySelectorAll('.nav-link').forEach(function(elem) {
      elem.addEventListener('click', function(event) {
        let id = elem.getAttribute('id');
        const currentUrl = window.location.href;
        const [baseUrl, queryString] = currentUrl.split('?');
        let newQueryString = '';
        if (queryString) {
            const queryParams = new URLSearchParams(queryString);
            queryParams.delete('month');
            queryParams.delete('year');
            newQueryString = queryParams.toString();
        } else {
            if(id == 'orders-pending-tab') {
                print.href = '/laporan-laba-rugi?data=thisMonth';
            } else {
                print.href = '/laporan-laba-rugi?data=all';
            }
            return false;
        }
        const newUrl = `${baseUrl}${newQueryString ? '?' : ''}${newQueryString}`;
        window.location.href = newUrl;
        event.preventDefault();
      });
    });

    print.addEventListener('click', function (event) {
        let hrefPrint = print.href.split('=')[1];
        if (hrefPrint == 'all') {
            if (document.querySelector('#orders-all table tbody').childElementCount == 0) {
                alert('Data yang akan dicetak tidak tersedia');
                print.style.backgroundColor = '#198754';
                print.style.color = '#fff';
                event.preventDefault();
            }
        } else if(hrefPrint == 'thisMonth') {
            if (document.querySelector('#orders-pending table tbody').childElementCount == 0) {
                alert('Data yang akan dicetak tidak tersedia');
                print.style.backgroundColor = '#198754';
                print.style.color = '#fff';
                event.preventDefault();
            }
        } else {
            if (document.querySelector('#orders-all table tbody').childElementCount == 0) {
                alert('Data yang akan dicetak tidak tersedia');
                print.style.backgroundColor = '#198754';
                print.style.color = '#fff';
                event.preventDefault();
            }
        }
    })
</script>
@endsection