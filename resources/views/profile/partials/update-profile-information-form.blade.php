<section>

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Informasi Profil</h3>
        </div>

        <form method="POST" action="{{ route('profile.update') }}">

            @csrf
            @method('PATCH')

            <div class="card-body">

                <div class="form-group">

                    <label for="name">Nama</label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                        autocomplete="name">

                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <div class="form-group">

                    <label for="email">Email</label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="username">

                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="alert alert-warning">

                    <p class="mb-2">
                        Email Anda belum diverifikasi.
                    </p>

                    <button
                        form="send-verification"
                        class="btn btn-warning btn-sm">

                        Kirim Ulang Email Verifikasi

                    </button>

                </div>

                @if (session('status') === 'verification-link-sent')

                <div class="alert alert-success mt-2 mb-0">

                    Link verifikasi baru telah dikirim ke email Anda.

                </div>

                @endif

                @endif

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Simpan Perubahan

                </button>

                @if (session('status') === 'profile-updated')

                <span class="text-success ml-3">

                    <i class="fas fa-check-circle"></i>

                    Berhasil disimpan.

                </span>

                @endif

            </div>

        </form>

    </div>

</section>

<form id="send-verification" method="POST" action="{{ route('verification.send') }}">
    @csrf
</form>