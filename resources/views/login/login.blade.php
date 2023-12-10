@extends('login.layout.main')

@section('title', 'Halaman Login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="_lk_de">
                <div class="form-03-main">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group nm_lk">
                            <h2>Login</h2>
                        </div>
                        <div class="logo">
                            <img src="{{ asset('/assets/images/logo_warung.png') }}">
                        </div>
                        <div class="form-group">
                            <input id="email" type="email"
                                class="form-control _ge_de_ol @error('email') is-invalid @enderror" name="email"
                                autocomplete="email" placeholder="Masukkan Email" required autofocus>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="input-group mb-3">
                            <input id="password" class="form-control _ge_de_ol" type="password" name="password"
                                autocomplete="current-password" placeholder="Masukkan Password" required>
                            <div class="input-group-append">
                                <button class="btn rounded-end btn-info" type="button">
                                    <h6 toggle="#password" class="fa fa-eye fa-lg show-hide"></h6>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary _btn_04">Login</button>
                        </div>

                        <p>Belum Punya Akun?
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('register') }}">
                                {{ __('Daftar Disini') }}
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection