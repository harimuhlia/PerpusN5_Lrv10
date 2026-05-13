<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Katalog Buku
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto">

            {{-- Alert Success --}}
            @if(session('success'))

                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">

                    {{ session('success') }}

                </div>

            @endif

            {{-- Alert Error --}}
            @if(session('error'))

                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">

                    {{ session('error') }}

                </div>

            @endif

            {{-- Search --}}
            <div class="bg-white p-6 rounded-lg shadow mb-6">

                <form action="{{ route('katalog.index') }}"
                      method="GET">

                    <div class="flex gap-2">

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari judul, pengarang, penerbit, kode buku..."
                               class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200">

                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 rounded-lg">

                            Cari

                        </button>

                    </div>

                </form>

            </div>

            {{-- Grid Buku --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @forelse($buku as $item)

                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition duration-300">

                        {{-- Cover --}}
                        @if($item->cover)

                            <img src="{{ asset('storage/' . $item->cover) }}"
                                 class="w-full h-72 object-cover">

                        @else

                            <div class="w-full h-72 bg-gray-200 flex items-center justify-center text-gray-500">

                                Tidak Ada Cover

                            </div>

                        @endif

                        <div class="p-4">

                            {{-- Judul --}}
                            <h2 class="font-bold text-lg min-h-[60px] text-gray-800">

                                {{ $item->judul }}

                            </h2>

                            {{-- Pengarang --}}
                            <p class="text-sm text-gray-600 mt-2">

                                {{ $item->pengarang }}

                            </p>

                            {{-- Detail --}}
                            <div class="mt-3 text-sm space-y-1">

                                <p>
                                    <span class="font-semibold">
                                        Kategori:
                                    </span>

                                    {{ $item->kategori->nama_kategori }}
                                </p>

                                <p>
                                    <span class="font-semibold">
                                        Rak:
                                    </span>

                                    {{ $item->rak->nama_rak }}
                                </p>

                                <p>
                                    <span class="font-semibold">
                                        Kode:
                                    </span>

                                    {{ $item->kode_buku }}
                                </p>

                                <p>
                                    <span class="font-semibold">
                                        Tahun:
                                    </span>

                                    {{ $item->tahun_terbit }}
                                </p>

                                <p>
                                    <span class="font-semibold">
                                        Stok:
                                    </span>

                                    @if($item->stok > 0)

                                        <span class="text-green-600 font-semibold">

                                            {{ $item->stok }} tersedia

                                        </span>

                                    @else

                                        <span class="text-red-600 font-semibold">

                                            Habis

                                        </span>

                                    @endif

                                </p>

                            </div>

                            {{-- Tombol --}}
                            <div class="mt-4 space-y-2">

                                {{-- Detail --}}
                                <a href="{{ route('katalog.show', $item->id) }}"
                                   class="w-full inline-block text-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">

                                    Detail Buku

                                </a>

                                {{-- Tombol Pinjam --}}
                                @if(Auth::user()->role == 'anggota')

                                    @if($item->stok > 0)

                                        <a href="{{ route('pinjam.create', $item->id) }}"
                                           class="w-full inline-block text-center bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">

                                            Pinjam Buku

                                        </a>

                                    @else

                                        <button disabled
                                                class="w-full bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed">

                                            Stok Habis

                                        </button>

                                    @endif

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-4 bg-white p-10 rounded-lg shadow text-center text-gray-500">

                        Buku tidak ditemukan

                    </div>

                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-6">

                {{ $buku->links() }}

            </div>

        </div>

    </div>

</x-app-layout>