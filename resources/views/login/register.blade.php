@extends('login.layout.main')

@section('title', 'Halaman Register')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="_lk_de">
                <div class="form-03-main">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group nm_lk">
                            <h2>Register</h2>
                        </div>
                        <div class="logo">
                            <img src="{{ asset('/assets/images/logo_warung.png') }}">
                        </div>

                        <!-- Name -->
                        <div class="form-group">
                            <input class="form-control _ge_de_ol @error('name') is-invalid @enderror" id="name"
                                type="text" name="name" :value="old('name')" placeholder="Masukkan Username" required
                                autofocus autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <input class="form-control _ge_de_ol @error('email') is-invalid @enderror" id="email"
                                type="email" name="email" :value="old('email')" placeholder="Masukkan Email" required
                                required autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="input-group mb-3">
                            <input id="password" class="form-control" type="password" name="password"
                                autocomplete="current-password" placeholder="Masukkan Password" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="input-group-append">
                                <button class="btn rounded-end btn-info" type="button">
                                    <h6 toggle="#password" class="fa fa-eye fa-lg show-hide"></h6>
                                </button>
                            </div>
                        </div>

                        <!-- Password Confirmation-->
                        <div class="input-group mb-3">
                            <input id="password_confirmation" class="form-control" type="password"
                                name="password_confirmation" autocomplete="current-password"
                                placeholder="Konfirmasi Password" required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            <div class="input-group-append">
                                <button class="btn rounded-end btn-info" type="button">
                                    <h6 toggle="#password_confirmation" class="fa fa-eye fa-lg show-hide"></h6>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary _btn_04">Register</button>
                        </div>

                        <p style="te">Sudah Register?
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}">
                                {{ __('Login Disini') }}
                            </a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection