@extends('layouts.main')

@section('container')

<!-- Button -->
<link rel="stylesheet" href="/css/button.css">

<div class="row g-3 settings-section">
    <div class="col-lg-7 mx-auto">
        <h1 class="app-page-title mb-4" style="text-align: center;">Edit Data Pembelian</h1>
        <div class="app-card app-card-settings p-4">
            <div class="app-card-body">
                <form action="{{ route('pembelian.update', $edit_pembelian->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="nama" class="form-label"><small>Supplier</small></label>
                            <select name="supplier_id" class="form-control selectNamaSupplier" id="supplier_id">
                                <option>Pilih Menu</option>
                                @foreach ($suppliers as $s)
                                <option value="{{ $s->id }}" {{ $edit_pembelian->supplier_id==
                                    $s->id ? 'selected' : '' }}>
                                    {{$s->nama}}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="nama" class="form-label"><small>Nama Barang</small></label>
                            <input type="text" class="form-control @error('nama_brg') is-invalid @enderror"
                                name="nama_brg" id="nama_brg" value="{{ old('nama_brg', $edit_pembelian->nama_brg) }}"
                                required>
                            @error('nama_brg')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="nama" class="form-label"><small>Tanggal Beli</small></label>
                            <input class="form-control" class='date' type="date" name="tgl_beli"
                                value="{{ old('tgl_beli', $edit_pembelian->tgl_beli) }}" min="1998-01-01"
                                style="width: 250px;" required>
                            @error('tgl_beli')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="nama" class="form-label"><small>Tanggal Produksi</small></label>
                            <input class="form-control" class='date' type="date" name="tgl_produksi"
                                value="{{ old('tgl_produksi', $edit_pembelian->tgl_produksi) }}" min="1998-01-01"
                                style="width: 250px;" required>
                            @error('tgl_produksi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="nama" class="form-label"><small>Tanggal Kadaluarsa</small></label>
                            <input class="form-control" class='date' type="date" name="exp"
                                value="{{ old('exp', $edit_pembelian->exp) }}" min="1998-01-01" style="width: 250px;"
                                required>
                            @error('exp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="nama" class="form-label"><small>Harga per Satuan/Kg</small></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp </span>
                                </div>
                                <input type="text" class="form-control harga" name="satuan" id="satuanInput"
                                    value="{{ old('satuan', $edit_pembelian->satuan) }}" data-type="currency" required>
                                @error('satuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="nama" class="form-label"><small>Jumlah Item/Kg</small></label><br>
                            <input class="form-control" type="text" name="jumlah" id="jumlahInput"
                                value="{{ old('jumlah', $edit_pembelian->jumlah) }}" onkeyup="sumar();" required>
                            @error('jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="nama" class="form-label"><small>Biaya Angkutan</small></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp </span>
                                </div>
                                <input type="text" class="form-control biaya" name="biaya_agkt" id="biayaAgktInput"
                                    value="{{ old('biaya_agkt', $edit_pembelian->biaya_agkt) }}" onkeyup="sumar();"
                                    data-type="currency" required>
                                @error('biaya_agkt')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="nama" class="form-label">
                                <span class="badge text-bg-info">Total</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" name="total" id="total"
                                    value="{{ old('total', number_format($edit_pembelian->total, 0, ',', '.')) }}"
                                    required readonly>
                                @error('total')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div><br><br>
                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn app-btn-info">Simpan</button>
                        <a href="{{ route('pembelian.index') }}" class="btn btn-danger text-white"
                            role="button">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/formatmoney-pembelian-total.js"></script>
<script src="/js/select.js"></script>

@endsection