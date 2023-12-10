@extends('layouts.main')

@section('container')
<div class="col-auto">
    <h1 class="app-page-title mb-0">Pembelian</h1>
</div>
<div class="col-10">
    <div class="page-utilities">
        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
            <div class="col-auto">
                <form action="/pembelian" method="GET" class="table-search-form row gx-1 align-items-center">
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
                    href="/laporan-pembelian?{{ isset($_GET['month']) && isset($_GET['year']) ? 'month='.$_GET['month'].'&year='.$_GET['year'] : (isset($_GET['month']) ? 'month='.$_GET['month'] : (isset($_GET['year']) ? 'year= '.$_GET['year'] : 'data=all')) }}"
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
                                <th class="cell">Tgl. Beli</th>
                                <th class="cell">Nama</th>
                                <th class="cell">Jumlah</th>
                                <th class="cell">Total</th>
                                <th class="cell" style="width: 300px;text-align:center"><i class="fa-solid fa-gear"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all as $item)
                            <tr>
                                <td class="cell">{{$loop->iteration}}</td>
                                <td class="cell">{{$item->kode}}</td>
                                @php
                                $tb = strtotime($item->tgl_beli);
                                @endphp
                                <td class="cell">
                                    {{date('d M Y', $tb)}}
                                </td>
                                <td class="cell">{{$item->nama_brg}}</td>
                                <td class="cell">{{$item->jumlah}} Item/Kg</td>
                                <td class="cell">Rp {{ number_format($item->total, 0, ',', '.')}}</td>
                                <td class="cell">
                                    <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST">
                                        <input type="hidden" value="{{ $item->id }}" id="pembelian_id">
                                        <a id="show-pembelian" class="btn btn-outline-info btn-xs"
                                            data-bs-toggle="modal" data-bs-target="#pembelianDetail" role="button"><i
                                                class="fa fa-eye"></i>
                                            Detail</a>
                                        <a class="btn btn-outline-warning btn-xs"
                                            href="{{ route('pembelian.edit',$item->id) }}">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-xs show-alert-delete-box"
                                            data-toggle="tooltip"><i class="fa fa-trash-o"></i> Hapus
                                        </button>
                                    </form>
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
                                <th class="cell">Tgl. Beli</th>
                                <th class="cell">Nama</th>
                                <th class="cell">Jumlah</th>
                                <th class="cell">Total</th>
                                <th class="cell" style="width: 300px;text-align:center"><i class="fa-solid fa-gear"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($today as $item)
                            <tr>
                                <td class="cell">{{$loop->iteration}}</td>
                                <td class="cell">{{$item->kode}}</td>
                                @php
                                $tb = strtotime($item->tgl_beli);
                                @endphp
                                <td class="cell">
                                    {{date('d M Y', $tb)}}
                                </td>
                                <td class="cell">{{$item->nama_brg}}</td>
                                <td class="cell">{{$item->jumlah}} Item/Kg</td>
                                <td class="cell">Rp {{ number_format($item->total, 0, ',', '.')}}</td>
                                <td class="cell">
                                    <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST">
                                        <input type="hidden" value="{{ $item->id }}" id="pembelian_id">
                                        <a id="show-pembelian" class="btn btn-outline-info btn-xs"
                                            data-bs-toggle="modal" data-bs-target="#pembelianDetail" role="button"><i
                                                class="fa fa-eye"></i>
                                            Detail</a>
                                        <a class="btn btn-outline-warning btn-xs"
                                            href="{{ route('pembelian.edit',$item->id) }}">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-xs show-alert-delete-box"
                                            data-toggle="tooltip"><i class="fa fa-trash-o"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $today->links() }}
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
                                <th class="cell">Tgl. Beli</th>
                                <th class="cell">Nama</th>
                                <th class="cell">Jumlah</th>
                                <th class="cell">Total</th>
                                <th class="cell" style="width: 300px;text-align:center"><i class="fa-solid fa-gear"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thisMonth as $item)
                            <tr>
                                <td class="cell">{{$loop->iteration}}</td>
                                <td class="cell">{{$item->kode}}</td>
                                @php
                                $tb = strtotime($item->tgl_beli);
                                @endphp
                                <td class="cell">
                                    {{date('d M Y', $tb)}}
                                </td>
                                <td class="cell">{{$item->nama_brg}}</td>
                                <td class="cell">{{$item->jumlah}} Item/Kg</td>
                                <td class="cell">Rp. {{ number_format($item->total, 0, ',', '.')}}</td>
                                <td class="cell">
                                    <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST">
                                        <input type="hidden" value="{{ $item->id }}" id="pembelian_id">
                                        <a id="show-pembelian" class="btn btn-outline-info btn-xs"
                                            data-bs-toggle="modal" data-bs-target="#pembelianDetail" role="button"><i
                                                class="fa fa-eye"></i>
                                            Detail</a>
                                        <a class="btn btn-outline-warning btn-xs"
                                            href="{{ route('pembelian.edit',$item->id) }}">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-xs show-alert-delete-box"
                                            data-toggle="tooltip"><i class="fa fa-trash-o"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $thisMonth->links() }}
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
            if (id == 'orders-paid-tab') {
                print.href = '/laporan-pembelian?data=today';
            } else if(id == 'orders-pending-tab') {
                print.href = '/laporan-pembelian?data=thisMonth';
            } else {
                print.href = '/laporan-pembelian?data=all';
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