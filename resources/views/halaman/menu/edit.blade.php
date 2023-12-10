@extends('layouts.main')

@section('container')

<!-- Button -->
<link rel="stylesheet" href="/css/button.css">

<div class="row g-3 settings-section">
    <div class="col-lg-7 mx-auto">
        <h1 class="app-page-title mb-4" style="text-align: center;">Edit Data Menu</h1>
        <div class="app-card app-card-settings p-4">
            <div class="app-card-body">
                <form action="/menu/{{ $menu_edit->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="name-product" class="form-label"><small>Nama Menu</small></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="name-product"
                            name="nama" value="{{ old('nama', $menu_edit->nama) }}" required>
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
                                    name="harga"
                                    value="{{ old('harga', number_format($menu_edit->harga, 0, ',', '.')) }}" required>
                                @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label"><small>Harga</small></label>

                    </div>
                    <div class="mb-4">
                        <label for="kategori" class="form-label"><small>Kategori</small></label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori"
                            name="kategori" required>
                            @if ( old('kategori', $menu_edit->kategori) == 'makanan' )
                            <option value="makanan" selected>Makanan</option>
                            <option value="minuman">Minuman</option>
                            @elseif( old('kategori', $menu_edit->kategori) == 'minuman' )
                            <option value="makanan">Makanan</option>
                            <option value="minuman" selected>Minuman</option>
                            @endif
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
                            style="height: 7rem;" id="deskripsi"
                            required>{{ old('deskripsi', $menu_edit->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="img">Foto Menu</label>
                        @error('picture')
                        <p class="small text-danger">{{ $message }}</p>
                        @enderror
                        <div class="img-area">
                            <img src="{{ asset('storage/' . $menu_edit->foto) }}" alt=""
                                class="img-fluid picture-preview" style="width:350px;height:auto">
                            <input type="file" id="select-picture" name="picture">
                            <div class="black-screen">{{ $menu_edit->foto }} <p> click to change </p>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: center">
                            <button type="submit" class="btn app-btn-info">Update</button>
                            <a href="{{ route('menu.index') }}" class="btn btn-danger text-white"
                                role="button">Batal</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const select_picture = document.getElementById('select-picture');
    const input_picture = document.getElementById('input-picture');
    const picture_preview = document.querySelector('.picture-preview');
    const black_screen = document.querySelector('.black-screen');

    select_picture.addEventListener('change', function () {
        const files = select_picture.files[0];
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
            picture_preview.src = this.result;
            black_screen.innerHTML = `${files.name} <p> click to change </p>`
        });
    })
    
</script>
<script src="/js/formatmoney.js"></script>
@endsection