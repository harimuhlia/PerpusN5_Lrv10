<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Buku
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-6xl mx-auto">

            {{-- Alert --}}
            @if(session('success'))

                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">

                    {{ session('success') }}

                </div>

            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">

                    {{-- Cover --}}
                    <div>

                        @if($buku->cover)

                            <img src="{{ asset('storage/' . $buku->cover) }}"
                                 class="w-full rounded-lg shadow object-cover">

                        @else

                            <div class="w-full h-[500px] bg-gray-200 flex items-center justify-center rounded-lg text-gray-500">

                                Tidak Ada Cover

                            </div>

                        @endif

                    </div>

                    {{-- Detail Buku --}}
                    <div class="md:col-span-2">

                        <h1 class="text-3xl font-bold text-gray-800">

                            {{ $buku->judul }}

                        </h1>

                        <p class="text-lg text-gray-600 mt-2">

                            {{ $buku->pengarang }}

                        </p>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div class="bg-gray-50 p-4 rounded-lg">

                                <p class="text-sm text-gray-500">
                                    Kode Buku
                                </p>

                                <p class="font-semibold">
                                    {{ $buku->kode_buku }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">

                                <p class="text-sm text-gray-500">
                                    Kategori
                                </p>

                                <p class="font-semibold">
                                    {{ $buku->kategori->nama_kategori }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">

                                <p class="text-sm text-gray-500">
                                    Rak
                                </p>

                                <p class="font-semibold">
                                    {{ $buku->rak->nama_rak }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">

                                <p class="text-sm text-gray-500">
                                    Tahun Terbit
                                </p>

                                <p class="font-semibold">
                                    {{ $buku->tahun_terbit }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">

                                <p class="text-sm text-gray-500">
                                    Penerbit
                                </p>

                                <p class="font-semibold">
                                    {{ $buku->penerbit }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">

                                <p class="text-sm text-gray-500">
                                    Stok
                                </p>

                                <p class="font-semibold">

                                    @if($buku->stok > 0)

                                        <span class="text-green-600">

                                            {{ $buku->stok }} tersedia

                                        </span>

                                    @else

                                        <span class="text-red-600">

                                            Stok Habis

                                        </span>

                                    @endif

                                </p>

                            </div>

                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-6">

                            <h3 class="text-xl font-bold mb-2">

                                Deskripsi Buku

                            </h3>

                            <div class="bg-gray-50 p-4 rounded-lg leading-relaxed text-gray-700">

                                {{ $buku->deskripsi ?? 'Tidak ada deskripsi buku.' }}

                            </div>

                        </div>

                        {{-- Tombol --}}
                        <div class="mt-6 flex flex-wrap gap-3">

                            {{-- Kembali --}}
                            <a href="{{ route('katalog.index') }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                                Kembali

                            </a>

                            {{-- Tombol Pinjam Khusus Anggota --}}
                            @if(Auth::user()->role == 'anggota')

                                @if($buku->stok > 0)

                                    <a href="{{ route('pinjam.create', $buku->id) }}"
                                       class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg">

                                        Pinjam Buku

                                    </a>

                                @else

                                    <button disabled
                                            class="bg-gray-400 text-white px-5 py-2 rounded-lg cursor-not-allowed">

                                        Stok Habis

                                    </button>

                                @endif

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>