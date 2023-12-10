<div class="col-lg-8 mx-auto mb-4 shadow rounded align-items-center bg-transparent">
    <div class="card" style="padding-top: 5%;padding-bottom: 5%;padding-left: 7%;padding-right: 7%;">
        <h2 class="app-page-title mb-4" style="text-align: center;">Ubah Password</h2>
        <h6>Form untuk mengubah data password</h6>
        <p>*Password harus kurang lebih 8 karakter. Agar aman, pastikan password anda
            mengandung huruf besar dan kecil, angka dan
            simbol.</p><br>
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <label for="name" class="form-label">Password Sekarang</label>
            <div class="input-group mb-3">
                <x-text-input id="current_password" name="current_password" type="password" class="form-control"
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                <span class="input-group-text">
                    <a href="#" class="toggle_hide_password">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </a>
                </span>
            </div>
            <label for="name" class="form-label">Password Baru</label>
            <div class="input-group mb-3">
                <x-text-input id="password" name="password" type="password" class="form-control"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                <span class="input-group-text">
                    <a href="#" class="toggle_hide_password">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </a>
                </span>
            </div>
            <label for="name" class="form-label">Konfirmasi Password Baru</label>
            <div class="input-group mb-3">
                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                    class="form-control" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                <span class="input-group-text">
                    <a href="#" class="toggle_hide_password">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </a>
                </span>
            </div>
            <br>
            <div class="form-group" style="text-align: center">
                <button type='submit' class="btn app-btn-primary">Simpan</button>

                @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</div>