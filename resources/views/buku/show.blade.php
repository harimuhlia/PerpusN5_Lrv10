<x-app-layout>

    <x-slot name="header">
        Detail Buku
    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white p-6 rounded-lg shadow">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div>

                        @if($buku->cover)

                            <img src="{{ asset('storage/' . $buku->cover) }}"
                                 class="w-full rounded shadow">

                        @else

                            <div class="bg-gray-200 h-80 flex items-center justify-center rounded">

                                Tidak Ada Cover

                            </div>

                        @endif

                    </div>

                    <div class="md:col-span-2 space-y-3">

                        <h2 class="text-2xl font-bold">
                            {{ $buku->judul }}
                        </h2>

                        <p>
                            <span class="font-semibold">Kode Buku:</span>
                            {{ $buku->kode_buku }}
                        </p>

                        <p>
                            <span class="font-semibold">Pengarang:</span>
                            {{ $buku->pengarang }}
                        </p>

                        <p>
                            <span class="font-semibold">Penerbit:</span>
                            {{ $buku->penerbit }}
                        </p>

                        <p>
                            <span class="font-semibold">Tahun Terbit:</span>
                            {{ $buku->tahun_terbit }}
                        </p>

                        <p>
                            <span class="font-semibold">Kategori:</span>
                            {{ $buku->kategori->nama_kategori }}
                        </p>

                        <p>
                            <span class="font-semibold">Rak:</span>
                            {{ $buku->rak->nama_rak }}
                        </p>

                        <div>

                            <span class="font-semibold">Deskripsi:</span>

                            <div class="mt-2 text-gray-700 leading-relaxed">

                                {{ $buku->deskripsi }}

                            </div>

                        </div>

                        <div class="pt-4">

                            <a href="{{ route('buku.index') }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                                Kembali

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>