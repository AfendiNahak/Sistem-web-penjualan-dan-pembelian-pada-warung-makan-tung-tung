@extends('layouts.main')

@section('container')
<!-- Button -->
<link rel="stylesheet" href="/css/button.css">

<div class="row g-3 settings-section">
    <div class="col-lg-7 mx-auto">
        <h1 class="app-page-title mb-4" style="text-align: center;">Edit Data Supplier</h1>
        <div class="app-card app-card-settings p-4">
            <div class="app-card-body">
                <form action="/supplier/{{ $supplier_edit->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="nama" class="form-label"><small>Nama Supplier</small></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            id="nama" placeholder="Input Nama Supplier" value="{{ old('nama', $supplier_edit->nama) }}"
                            required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="email" class="form-label"><small>Email</small></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="Cth. alex@gmail.com"
                                    value="{{ old('email', $supplier_edit->email) }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="no_telp" class="form-label"><small>Nomor Telepon</small></label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                    name="no_telp" id="no_telp" placeholder="Input Nomor Telepon"
                                    value="{{ old('no_telp', $supplier_edit->no_telp) }}" required>
                                @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="form-label"><small>Kota</small></label>
                        <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota"
                            id="kota" placeholder="Input Kota Asal Supplier"
                            value="{{ old('kota', $supplier_edit->kota) }}" required>
                        @error('kota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label"><small>Alamat</small></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            style="height: 7rem;" id="alamat" placeholder="Input Alamat"
                            required>{{ old('alamat', $supplier_edit->alamat) }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn app-btn-info">Update</button>
                        <a href="{{ route('supplier.index') }}" class="btn btn-danger text-white"
                            role="button">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/formatmoney.js"></script>
@endsection