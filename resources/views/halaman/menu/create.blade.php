@extends('layouts.main')

@section('container')

<!-- Button -->
<link rel="stylesheet" href="/css/button.css">

<div class="row g-3 settings-section">
    <div class="col-lg-7 mx-auto">
        <h1 class="app-page-title mb-4" style="text-align: center;">Tambah Menu Baru</h1>
        <div class="app-card app-card-settings p-4">
            <div class="app-card-body">
                <form action="/menu" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name-product" class="form-label"><small>Nama Menu</small></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="name-product"
                            name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label"><small>Harga</small></label>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                    name="harga" value="{{ old('harga') }}" required>
                                @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="kategori" class="form-label"><small>Kategori</small></label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori"
                            name="kategori" required>
                            <option selected disabled hidden>-- Pilih Kategori --</option>
                            <option value="makanan" @if (old('kategori')=="makanan" ) {{ 'selected' }} @endif>Makanan
                            </option>
                            <option value="minuman" @if (old('kategori')=="minuman" ) {{ 'selected' }} @endif>Minuman
                            </option>
                        </select>
                        @error('kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label"><small>Deskripsi</small></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                            style="height: 7rem;" id="deskripsi" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="img">Foto Menu</label>
                        @error('image')
                        <p class="small text-danger">{{ $message }}</p>
                        @enderror
                        <div class="img-area">
                            <img class="img-preview">
                            <input type="file" id="img" class="select-image" name="image">
                            <div class="view-path-img" data-path="false">
                                <h3>Upload Foto</h3>
                                <p>Ukuran gambar harus kurang dari <span>2MB</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn app-btn-info">Simpan</button>
                        <a href="{{ route('menu.index') }}" class="btn btn-danger text-white" role="button">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const img = document.getElementById('img');
        const img_preview = document.querySelector('.img-preview');
        const view_path_img = document.querySelector('.view-path-img');
        const select_image = document.querySelector('.select-image');
        
        img.addEventListener('change', function() {
            const files = img.files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function () {
                img_preview.src = this.result;
                img_preview.style.opacity = '1';
                view_path_img.innerHTML = ` <h3>${files.name}</h3> <p>click to change</p>`;
                view_path_img.setAttribute('data-path','true');
            });
        })
</script>
<script src="/js/formatmoney.js"></script>
@endsection