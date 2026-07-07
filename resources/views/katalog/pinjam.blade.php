<x-app-layout>

    <x-slot name="header">
        Pinjam Buku
    </x-slot>

    <div class="py-6">

        <div class="max-w-xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <h2 class="text-xl font-bold mb-4">
                    {{ $buku->judul }}
                </h2>

                <form action="{{ route('katalog.pinjam', $buku->id) }}"
                      method="POST">

                    @csrf

                    <div>

                        <label>Durasi Peminjaman (Hari)</label>

                        <input type="number"
                               name="durasi_pinjam"
                               min="1"
                               required
                               class="w-full border rounded p-3">

                    </div>

                    <div class="mt-4">

                        <button type="submit"
                                class="bg-green-500 text-white px-5 py-2 rounded">

                            Pinjam Buku

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>