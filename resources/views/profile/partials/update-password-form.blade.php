<section>

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                Ubah Password
            </h3>

        </div>

        <form method="POST" action="{{ route('password.update') }}">

            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">

                    <label for="update_password_current_password">
                        Password Lama
                    </label>

                    <input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                        autocomplete="current-password">

                    @error('current_password', 'updatePassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <div class="form-group">

                    <label for="update_password_password">
                        Password Baru
                    </label>

                    <input
                        id="update_password_password"
                        name="password"
                        type="password"
                        class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                        autocomplete="new-password">

                    @error('password', 'updatePassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <div class="form-group">

                    <label for="update_password_password_confirmation">
                        Konfirmasi Password Baru
                    </label>

                    <input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="form-control"
                        autocomplete="new-password">

                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-primary">

                    <i class="fas fa-key"></i>

                    Simpan Password

                </button>

                @if (session('status') === 'password-updated')

                <span class="text-success ml-3">

                    <i class="fas fa-check-circle"></i>

                    Password berhasil diperbarui.

                </span>

                @endif

            </div>

        </form>

    </div>

</section>