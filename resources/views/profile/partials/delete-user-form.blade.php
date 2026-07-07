<section>

    <div class="card card-outline card-danger">

        <div class="card-header">

            <h3 class="card-title">
                Hapus Akun
            </h3>

        </div>

        <div class="card-body">

            <p class="text-muted">
                Setelah akun dihapus, seluruh data yang berkaitan dengan akun ini akan ikut terhapus secara permanen.
                Pastikan Anda telah melakukan backup jika masih memerlukan data tersebut.
            </p>

        </div>

        <div class="card-footer">

            <button
                type="button"
                class="btn btn-danger"
                data-toggle="modal"
                data-target="#modalDeleteAccount">

                <i class="fas fa-trash"></i>
                Hapus Akun

            </button>

        </div>

    </div>

</section>


<!-- Modal -->
<div class="modal fade" id="modalDeleteAccount" tabindex="-1">

    <div class="modal-dialog">

        <form method="post" action="{{ route('profile.destroy') }}">

            @csrf
            @method('delete')

            <div class="modal-content">

                <div class="modal-header bg-danger">

                    <h5 class="modal-title">

                        Konfirmasi Hapus Akun

                    </h5>

                    <button type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <p>

                        Apakah Anda yakin ingin menghapus akun ini?

                    </p>

                    <p class="text-muted">

                        Tindakan ini tidak dapat dibatalkan. Semua data yang terkait dengan akun ini akan dihapus secara permanen.

                    </p>

                    <div class="form-group">

                        <label>

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                            placeholder="Masukkan password">

                        @error('password', 'userDeletion')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-danger">

                        <i class="fas fa-trash"></i>

                        Ya, Hapus Akun

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>