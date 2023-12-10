<div class="col-lg-8 mx-auto mb-4 shadow rounded align-items-center bg-transparent">
    <div class="card" style="padding-top: 5%;padding-bottom: 5%;padding-left: 7%;padding-right: 7%;">
        <h2 class="app-page-title mb-4" style="text-align: left;">Hapus Akun</h2>
        <p>*Jika menghapus akun maka anda tidak akan lagi dapat login ke website ini dan semua data yang terkait dengan
            akun akan terhapus secara permanen. Pastikan mengamankan data anda sebelum menghapus akun!
        </p><br>
        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
            data-bs-target="#modalHapusAkun">Hapus
            Akun</button>
    </div>
</div>

<div class="modal fade" id="modalHapusAkun" tabindex="-1" aria-labelledby="modalHapusAkunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusAkunLabel">Apa Anda Yakin Untuk Menghapus Akun?</h5>
            </div>
            <div class="modal-body">
                <p><strong>Jika menghapus akun maka anda tidak akan lagi dapat login ke website ini. Anda harus
                        mendaftar ulang
                        jika ingin login.</strong></p>
                <hr>
                <p>*Silahkan masukkan password anda untuk menghapus akun.</p>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="input-group mb-3">
                        <x-text-input id="passwordPwDelete" name="password" type="password" class="form-control"
                            placeholder="{{ __('Password') }}" />
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        <span class="input-group-text">
                            <a href="#" class="toggle_hide_password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </a>
                        </span>
                    </div>
                    <hr> <br>
                    <div class="form-group" style="text-align: right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <x-danger-button class="btn btn-danger ml-3">
                            {{ __('Hapus Akun') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>