<div class="col-lg-8 mx-auto mb-4 shadow rounded align-items-center bg-transparent">
    <div class="card" style="padding-top: 5%;padding-bottom: 5%;padding-left: 7%;padding-right: 7%;">
        <h2 class="app-page-title mb-4" style="text-align: center;">Informasi Profil</h2>
        <h6>Form untuk mengubah data username dan email</h6><br>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <x-text-input id="name" name="name" type="text" class="form-control mt-1 block w-full"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <x-text-input id="email" name="email" type="email" class="form-control mt-1 block w-full"
                    :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !
                $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div><br>
            <div class="form-group" style="text-align: center">
                <button type='submit' class="btn app-btn-primary">Simpan</button>

                @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 10)"
                    class="text-sm text-gray-600">{{
                    __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</div>