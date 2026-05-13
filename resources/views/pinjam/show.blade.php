<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Peminjaman Buku
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                {{-- Header --}}
                <div class="p-6 border-b border-gray-200">

                    <h2 class="text-2xl font-bold text-gray-800">
                        Detail Peminjaman
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Informasi lengkap data peminjaman buku
                    </p>

                </div>

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                        {{-- Cover Buku --}}
                        <div>

                            @if($pinjam->buku->cover)

                                <img src="{{ asset('storage/' . $pinjam->buku->cover) }}"
                                     class="w-full rounded-lg shadow">

                            @else

                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">

                                    Tidak Ada Cover

                                </div>

                            @endif

                        </div>

                        {{-- Detail --}}
                        <div class="md:col-span-2">

                            <div class="space-y-5">

                                {{-- Judul --}}
                                <div>

                                    <h3 class="text-2xl font-bold text-gray-800">

                                        {{ $pinjam->buku->judul }}

                                    </h3>

                                    <p class="text-gray-500 mt-1">

                                        {{ $pinjam->buku->pengarang }}

                                    </p>

                                </div>

                                {{-- Informasi Buku --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div>

                                        <p class="text-sm text-gray-500">
                                            Kode Buku
                                        </p>

                                        <p class="font-semibold text-gray-800">
                                            {{ $pinjam->buku->kode_buku }}
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-sm text-gray-500">
                                            Penerbit
                                        </p>

                                        <p class="font-semibold text-gray-800">
                                            {{ $pinjam->buku->penerbit }}
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-sm text-gray-500">
                                            Tahun Terbit
                                        </p>

                                        <p class="font-semibold text-gray-800">
                                            {{ $pinjam->buku->tahun_terbit }}
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-sm text-gray-500">
                                            Kategori
                                        </p>

                                        <p class="font-semibold text-gray-800">
                                            {{ $pinjam->buku->kategori->nama_kategori }}
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-sm text-gray-500">
                                            Rak
                                        </p>

                                        <p class="font-semibold text-gray-800">
                                            {{ $pinjam->buku->rak->nama_rak }}
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-sm text-gray-500">
                                            Stok Buku
                                        </p>

                                        <p class="font-semibold text-gray-800">
                                            {{ $pinjam->buku->stok }}
                                        </p>

                                    </div>

                                </div>

                                {{-- Informasi Peminjaman --}}
                                <div class="border-t pt-6">

                                    <h4 class="text-lg font-bold text-gray-800 mb-4">

                                        Informasi Peminjaman

                                    </h4>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                        <div>

                                            <p class="text-sm text-gray-500">
                                                Nama Peminjam
                                            </p>

                                            <p class="font-semibold text-gray-800">
                                                {{ $pinjam->user->name }}
                                            </p>

                                        </div>

                                        <div>

                                            <p class="text-sm text-gray-500">
                                                Durasi Pinjam
                                            </p>

                                            <p class="font-semibold text-gray-800">
                                                {{ $pinjam->durasi_pinjam }} Hari
                                            </p>

                                        </div>

                                        <div>

                                            <p class="text-sm text-gray-500">
                                                Tanggal Pinjam
                                            </p>

                                            <p class="font-semibold text-gray-800">
                                                {{ $pinjam->tanggal_pinjam }}
                                            </p>

                                        </div>

                                        <div>

                                            <p class="text-sm text-gray-500">
                                                Tanggal Kembali
                                            </p>

                                            <p class="font-semibold text-gray-800">
                                                {{ $pinjam->tanggal_kembali }}
                                            </p>

                                        </div>

                                        <div>

                                            <p class="text-sm text-gray-500">
                                                Status
                                            </p>

                                            <div class="mt-1">

                                                @if($pinjam->status == 'pending')

                                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">

                                                        Pending

                                                    </span>

                                                @elseif($pinjam->status == 'dipinjam')

                                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">

                                                        Dipinjam

                                                    </span>

                                                @else

                                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">

                                                        Dikembalikan

                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{-- Deskripsi --}}
                                <div class="border-t pt-6">

                                    <h4 class="text-lg font-bold text-gray-800 mb-2">

                                        Deskripsi Buku

                                    </h4>

                                    <p class="text-gray-700 leading-relaxed">

                                        {{ $pinjam->buku->deskripsi ?? 'Tidak ada deskripsi buku.' }}

                                    </p>

                                </div>

                                {{-- Tombol --}}
                                <div class="pt-6 flex flex-wrap gap-3">

                                    <a href="{{ route('pinjam.index') }}"
                                       class="inline-flex items-center px-5 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 transition">

                                        Kembali

                                    </a>

                                    @if(Auth::user()->role == 'admin')

                                        {{-- Setujui --}}
                                        @if($pinjam->status == 'pending')

                                            <form action="{{ route('pinjam.setujui', $pinjam->id) }}"
                                                  method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button type="submit"
                                                        class="inline-flex items-center px-5 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 transition">

                                                    Setujui

                                                </button>

                                            </form>

                                        @endif

                                        {{-- Kembalikan --}}
                                        @if($pinjam->status == 'dipinjam')

                                            <form action="{{ route('pinjam.kembalikan', $pinjam->id) }}"
                                                  method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button type="submit"
                                                        class="inline-flex items-center px-5 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 transition">

                                                    Kembalikan

                                                </button>

                                            </form>

                                        @endif

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>