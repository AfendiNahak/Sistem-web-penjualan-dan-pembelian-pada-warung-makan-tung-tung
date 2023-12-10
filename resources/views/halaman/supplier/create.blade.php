@extends('layouts.main')

@section('container')
<!-- Button -->
<link rel="stylesheet" href="/css/button.css">

<div class="row g-3 settings-section">
    <div class="col-lg-7 mx-auto">
        <h1 class="app-page-title mb-4" style="text-align: center;">Tambah Data Supplier</h1>
        <div class="app-card app-card-settings p-4">
            <div class="app-card-body">
                <form action="/supplier" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label"><small>Nama Supplier</small></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            id="nama" value="{{ old('nama') }}" required>
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
                                    name="email" id="email" value="{{ old('email') }}">
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
                                    name="no_telp" id="no_telp" value="{{ old('no_telp') }}" required>
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
                            id="kota" value="{{ old('kota') }}" required>
                        @error('kota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label"><small>Alamat</small></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            style="height: 7rem;" id="alamat" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn app-btn-info">Simpan</button>
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