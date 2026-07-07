<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        {{ $buku->judul }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm border-b">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center h-16">

                {{-- LOGO --}}
                <a href="/"
                   class="flex items-center gap-2">

                    <span class="text-2xl">
                        📚
                    </span>

                    <span class="font-bold text-xl text-blue-600">
                        Perpustakaan Digital
                    </span>

                </a>

                {{-- MENU --}}
                <div class="flex items-center gap-3">

                    @auth

                        @if(Auth::user()->role == 'anggota')

                            <a href="{{ route('anggota.dashboard') }}"
                            class="px-5 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded-xl font-medium transition">

                                📚 Dashboard Anggota

                            </a>

                        @else

                            <a href="{{ route('dashboard') }}"
                            class="px-5 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded-xl font-medium transition">

                                ⚙️ Dashboard Admin

                            </a>

                        @endif

                    @else

                        <a href="{{ route('login') }}"
                           class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-medium transition">

                            Login

                        </a>

                        <a href="{{ route('register') }}"
                           class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl font-medium transition">

                            Register

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>

    {{-- CONTENT --}}
    <section class="py-10">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ALERT --}}
            @if(session('success'))

                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">

                    {{ session('success') }}

                </div>

            @endif

            {{-- DETAIL --}}
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6 lg:p-8">

                    {{-- COVER --}}
                    <div>

                        @if($buku->cover)

                            <img src="{{ asset('storage/' . $buku->cover) }}"
                                 class="w-full rounded-2xl shadow-lg object-cover">

                        @else

                            <div class="w-full h-[500px] bg-gray-200 flex items-center justify-center rounded-2xl text-gray-500">

                                Tidak Ada Cover

                            </div>

                        @endif

                    </div>

                    {{-- DETAIL --}}
                    <div class="lg:col-span-2">

                        {{-- STATUS --}}
                        <div class="mb-4">

                            @if($buku->stok > 0)

                                <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">

                                    ✅ Buku Tersedia

                                </span>

                            @else

                                <span class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-semibold">

                                    ❌ Stok Habis

                                </span>

                            @endif

                        </div>

                        {{-- JUDUL --}}
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 leading-tight">

                            {{ $buku->judul }}

                        </h1>

                        {{-- PENGARANG --}}
                        <p class="text-lg text-gray-500 mt-3">

                            {{ $buku->pengarang ?? '-' }}

                        </p>

                        {{-- GRID INFO --}}
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div class="bg-gray-50 p-5 rounded-2xl border">

                                <p class="text-sm text-gray-500 mb-1">
                                    Kode Buku
                                </p>

                                <p class="font-semibold text-gray-800">
                                    {{ $buku->kode_buku }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-5 rounded-2xl border">

                                <p class="text-sm text-gray-500 mb-1">
                                    Kategori
                                </p>

                                <p class="font-semibold text-gray-800">
                                    {{ $buku->kategori->nama_kategori ?? '-' }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-5 rounded-2xl border">

                                <p class="text-sm text-gray-500 mb-1">
                                    Rak Buku
                                </p>

                                <p class="font-semibold text-gray-800">
                                    {{ $buku->rak->nama_rak ?? '-' }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-5 rounded-2xl border">

                                <p class="text-sm text-gray-500 mb-1">
                                    Tahun Terbit
                                </p>

                                <p class="font-semibold text-gray-800">
                                    {{ $buku->tahun_terbit ?? '-' }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-5 rounded-2xl border">

                                <p class="text-sm text-gray-500 mb-1">
                                    Penerbit
                                </p>

                                <p class="font-semibold text-gray-800">
                                    {{ $buku->penerbit ?? '-' }}
                                </p>

                            </div>

                            <div class="bg-gray-50 p-5 rounded-2xl border">

                                <p class="text-sm text-gray-500 mb-1">
                                    Stok Buku
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

                    </div>

                </div>

                {{-- DESKRIPSI --}}
                <div class="px-6 lg:px-8 pb-8">

                    <div class="border-t pt-8">

                        <h3 class="text-2xl font-bold text-gray-800 mb-4">

                            📖 Deskripsi Buku

                        </h3>

                        <div class="bg-gray-50 border rounded-2xl p-6 leading-loose text-gray-700 text-justify">

                            {{ $buku->deskripsi ?? 'Tidak ada deskripsi buku.' }}

                        </div>

                    </div>

                {{-- BUTTON --}}
                <div class="mt-10 pt-6 border-t border-gray-200">

                    <div class="flex flex-wrap gap-4">

                        {{-- KEMBALI --}}
                        <a href="/"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition shadow-sm">

                            ← Kembali

                        </a>

                    {{-- TOMBOL PINJAM --}}
                    @auth

                        @if(Auth::user()->role == 'anggota')

                            @if($buku->stok > 0)

                                <a href="{{ route('pinjam.create', $buku->id) }}"
                                class="inline-flex items-center justify-center w-fit px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-xl font-semibold transition shadow-sm">

                                    📚 Pinjam Buku

                                </a>

                            @else

                                <button disabled
                                        class="inline-flex items-center justify-center w-fit px-6 py-3 bg-gray-400 text-white rounded-xl cursor-not-allowed shadow-sm">

                                    Stok Habis

                                </button>

                            @endif

                        @endif

                    @else

                        <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center w-fit px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-semibold transition shadow-sm">

                            🔐 Login Untuk Meminjam

                        </a>

                    @endauth
                    </div>

                </div>

                {{-- REKOMENDASI --}}
                <div class="mt-16">

                    <div class="mb-7">

                        <h2 class="text-3xl font-bold text-gray-800">
                            Buku Lainnya
                        </h2>

                        <p class="text-gray-500 mt-1">
                            Rekomendasi buku lainnya
                        </p>

                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">

                        @foreach($rekomendasi as $item)

                            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition duration-300 overflow-hidden border border-gray-100">

                                {{-- COVER --}}
                                <div class="h-72 bg-gray-100 overflow-hidden">

                                    @if($item->cover)

                                        <img src="{{ asset('storage/'.$item->cover) }}"
                                            class="w-full h-full object-cover hover:scale-105 transition duration-300">

                                    @else

                                        <div class="w-full h-full flex items-center justify-center text-gray-400">

                                            No Cover

                                        </div>

                                    @endif

                                </div>

                                {{-- BODY --}}
                                <div class="p-5">

                                    <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2 leading-snug min-h-[56px]">

                                        {{ $item->judul }}

                                    </h3>

                                    <div class="text-sm text-gray-500 mb-5">

                                        {{ $item->kategori->nama_kategori ?? '-' }}

                                    </div>

                                    <a href="{{ route('front.detail-buku', $item->id) }}"
                                    class="block text-center bg-blue-500 hover:bg-blue-600 text-white py-2.5 rounded-xl font-medium transition">

                                        Detail Buku

                                    </a>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

        </div>

    </section>
                </div> {{-- END REKOMENDASI --}}

        </div> {{-- END DETAIL CONTENT --}}

    </section>

    {{-- FOOTER --}}
    <footer class="bg-slate-900 text-slate-300 mt-20">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                {{-- BRAND --}}
                <div>

                    <h3 class="text-2xl font-bold text-white mb-4">

                        📚 Perpustakaan Digital

                    </h3>

                    <p class="leading-relaxed text-slate-400">

                        Sistem Perpustakaan Digital Sekolah yang membantu
                        peserta didik dan guru mengakses koleksi buku
                        dengan mudah, cepat, dan modern.

                    </p>

                </div>

                {{-- MENU --}}
                <div>

                    <h4 class="text-lg font-semibold text-white mb-4">

                        Menu Utama

                    </h4>

                    <ul class="space-y-3">

                        <li>

                            <a href="/"
                            class="hover:text-white transition">

                                Beranda

                            </a>

                        </li>

                        @guest

                            <li>

                                <a href="{{ route('login') }}"
                                class="hover:text-white transition">

                                    Login

                                </a>

                            </li>

                            <li>

                                <a href="{{ route('register') }}"
                                class="hover:text-white transition">

                                    Register

                                </a>

                            </li>

                        @endguest

                        @auth

                            <li>

                                <a href="{{ route('anggota.dashboard') }}"
                                class="hover:text-white transition">

                                    Dashboard

                                </a>

                            </li>

                        @endauth

                    </ul>

                </div>

                {{-- INFO --}}
                <div>

                    <h4 class="text-lg font-semibold text-white mb-4">

                        Informasi Perpustakaan

                    </h4>

                    <div class="space-y-2 text-slate-400">

                        <p>
                            🕒 Senin - Jumat
                        </p>

                        <p>
                            07.00 - 15.00 WIB
                        </p>

                        <p>
                            📍 Perpustakaan Sekolah
                        </p>

                        <p>
                            📖 Membaca Hari Ini, Sukses Esok Hari
                        </p>

                    </div>

                </div>

            </div>

            {{-- COPYRIGHT --}}
            <div class="border-t border-slate-800 mt-10 pt-6 text-center text-slate-500 text-sm">

                © {{ date('Y') }} Perpustakaan Digital Sekolah.
                All Rights Reserved.

            </div>

        </div>

    </footer>

</body>

</html>