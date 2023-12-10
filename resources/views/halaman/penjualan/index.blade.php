@extends('layouts.main')

@section('container')
<div class="col-auto">
    <h1 class="app-page-title mb-0">Penjualan</h1>
</div>
<div class="col-10">
    <div class="page-utilities">
        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
            <div class="col-auto">
                <form action="/penjualan" method="GET" class="table-search-form row gx-1 align-items-center">
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
                    href="/laporan-penjualan?{{ isset($_GET['month']) && isset($_GET['year']) ? 'month='.$_GET['month'].'&year='.$_GET['year'] : (isset($_GET['month']) ? 'month='.$_GET['month'] : (isset($_GET['year']) ? 'year= '.$_GET['year'] : 'data=all')) }}"
                    formtarget="_blank" id="print"><i class="fa-solid fa-print me-2"></i>Cetak Laporan</a>
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
        aria-selected="{{ Request::has('month') || Request::has('year') ? 'false' : 'true' }}">Semua Data</a>
    <a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab"
        href="{{ Request::has('month') || Request::has('year') ? ' ' : '#orders-paid' }}" role="tab"
        aria-controls="orders-paid" aria-selected="false">Hari Ini</a>
    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab"
        href="{{ Request::has('month') || Request::has('year') ? ' ' : '#orders-pending' }}" role="tab"
        aria-controls="orders-pending" aria-selected="false">Bulan Ini</a>
</nav>

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">No</th>
                                <th class="cell">Kode</th>
                                <th class="cell">Menu</th>
                                <th class="cell">Tanggal</th>
                                <th class="cell">Status</th>
                                <th class="cell">Total</th>
                                <th class="cell" style="width: 150px;text-align:center"><i class="fa-solid fa-gear"></i>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all as $item)
                            @php
                            $datetime = explode(' ', $item->created_at)[0];
                            $date = \Carbon\Carbon::parse($datetime);

                            $times_ex = explode(' ', $item->created_at)[1];
                            $times = \Carbon\Carbon::parse($times_ex);
                            $time = explode(' ', $times->toDayDateTimeString());
                            @endphp
                            <tr>
                                <td class="cell">{{ $loop->iteration }}</td>
                                <td class="cell">{{ $item->kode }}</td>
                                <td class="cell">
                                    <span class="truncate">
                                        @foreach ($item->transaction_details as $el)
                                        {{ $el->menu->nama.',' }}
                                        @endforeach
                                    </span>
                                </td>
                                <td class="cell"><span>{{ $item->created_at->format('d M Y') }}</span></td>
                                <td class="cell"><span
                                        class="badge {{ $item->status == 'paid' ? 'bg-success' : 'bg-danger'}}">{{
                                        $item->status }}</span></td>
                                <td class="cell">Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td class="cell" style="width: 150px;text-align:center">
                                    <a class="btn btn-outline-info btn-xs" href="/penjualan/{{ $item->id }}">
                                        <i class="fa fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $all->withQueryString()->links() }}
    </div>

    <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
        <div class="app-card app-card-orders-table mb-5">
            <div class="app-card-body">
                <div class="table-responsive">

                    <table class="table mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">No</th>
                                <th class="cell">Kode</th>
                                <th class="cell">Menu</th>
                                <th class="cell">Tanggal</th>
                                <th class="cell">Status</th>
                                <th class="cell">Total</th>
                                <th class="cell" style="width: 150px;text-align:center"><i class="fa-solid fa-gear"></i>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($today as $item)
                            @php
                            $datetime = explode(' ', $item->created_at)[0];
                            $date = \Carbon\Carbon::parse($datetime);

                            $times_ex = explode(' ', $item->created_at)[1];
                            $times = \Carbon\Carbon::parse($times_ex);
                            $time = explode(' ', $times->toDayDateTimeString());
                            @endphp
                            <tr>
                                <td class="cell">{{ $loop->iteration }}</td>
                                <td class="cell">{{ $item->kode }}</td>
                                <td class="cell">
                                    <span class="truncate">
                                        @foreach ($item->transaction_details as $el)
                                        {{ $el->menu->nama.',' }}
                                        @endforeach
                                    </span>
                                </td>
                                <td class="cell"><span>{{ $item->created_at->format('d M Y') }}</span></td>
                                <td class="cell"><span
                                        class="badge {{ $item->status == 'paid' ? 'bg-success' : 'bg-danger'}}">{{
                                        $item->status }}</span></td>
                                <td class="cell">IDR. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td class="cell" style="width: 150px;text-align:center"><a
                                        class="btn btn-outline-info btn-xs" href="/penjualan/{{ $item->id }}"><i
                                            class="fa fa-eye"></i>
                                        Detail</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $today->withQueryString()->links() }}
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
                                <th class="cell">Kode</th>
                                <th class="cell">Menu</th>
                                <th class="cell">Tanggal</th>
                                <th class="cell">Status</th>
                                <th class="cell">Total</th>
                                <th class="cell" style="width: 150px;text-align:center"><i class="fa-solid fa-gear"></i>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thisMonth as $item)
                            @php
                            $datetime = explode(' ', $item->created_at)[0];
                            $date = \Carbon\Carbon::parse($datetime);

                            $times_ex = explode(' ', $item->created_at)[1];
                            $times = \Carbon\Carbon::parse($times_ex);
                            $time = explode(' ', $times->toDayDateTimeString());
                            @endphp
                            <tr>
                                <td class="cell">{{ $loop->iteration }}</td>
                                <td class="cell">{{ $item->kode }}</td>
                                <td class="cell">
                                    <span class="truncate">
                                        @foreach ($item->transaction_details as $el)
                                        {{ $el->menu->nama.',' }}
                                        @endforeach
                                    </span>
                                </td>
                                <td class="cell"><span>{{ $item->created_at->format('d M Y') }}</span></td>
                                <td class="cell"><span
                                        class="badge {{ $item->status == 'paid' ? 'bg-success' : 'bg-danger'}}">{{
                                        $item->status }}</span></td>
                                <td class="cell">Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td class="cell" style="width: 150px;text-align:center"><a
                                        class="btn btn-outline-info btn-xs" href="/penjualan/{{ $item->id }}"><i
                                            class="fa fa-eye"></i>
                                        Detail</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $thisMonth->withQueryString()->links() }}
    </div>
</div>
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
            if (id == 'orders-paid-tab') {
                print.href = '/laporan-penjualan?data=today';
            } else if(id == 'orders-pending-tab') {
                print.href = '/laporan-penjualan?data=thisMonth';
            } else {
                print.href = '/laporan-penjualan?data=all';
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
        } else if(hrefPrint == 'today') {
            if (document.querySelector('#orders-paid table tbody').childElementCount == 0) {
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