@extends('layouts.main')

@section('container')

<!-- Button -->
<link rel="stylesheet" href="/css/button.css">

<div class="row g-3 settings-section">
    <div class="col-lg-7 mx-auto">
        <h1 class="app-page-title mb-4" style="text-align: center;">Edit Data Pembelian</h1>
        <div class="app-card app-card-settings p-4">
            <div class="app-card-body">
                <form action="{{ route('biaya-lain.update', $edit_biayalain->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="nama" class="form-label"><small>Tanggal Transaksi</small></label>
                            <input class="form-control" class='date' type="date" name="tgl_transaksi"
                                value="{{ old('tgl_transaksi', $edit_biayalain->tgl_transaksi) }}" min="1998-01-01"
                                required>
                            @error('tgl_transaksi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="nama" class="form-label"><small>Nama</small></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" value="{{ old('nama', $edit_biayalain->nama) }}" required>
                            @error('nama')
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
                                <input type="text" class="form-control harga" name="harga" id="hargaInput"
                                    value="{{ old('harga', $edit_biayalain->harga) }}" data-type="currency" required>
                                @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="nama" class="form-label"><small>Jumlah Item/Kg</small></label><br>
                            <input class="form-control" type="text" name="jumlah" id="jumlahInput"
                                value="{{ old('jumlah', $edit_biayalain->jumlah) }}" onkeyup="sumar();" required>
                            @error('jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="nama" class="form-label">
                                <span class="badge text-bg-info">Total</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" name="total" id="total"
                                    value="{{ old('total', number_format($edit_biayalain->total, 0, ',', '.')) }}"
                                    required readonly>
                                @error('total')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div><br><br>
                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn app-btn-info">Simpan</button>
                        <a href="{{ route('biaya-lain.index') }}" class="btn btn-danger text-white"
                            role="button">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/formatmoney-biayalain-total.js"></script>

@endsection