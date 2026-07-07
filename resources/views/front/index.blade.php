<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perpustakaan Digital</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-100">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">

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

                        @if (Auth()->user()->role == 'admin')
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition shadow-sm">

                            Dashboard
                        </a>
                        @elseif (Auth()->user()->role == 'anggota')
                        <a href="{{ route('anggota.dashboard') }}"
                           class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition shadow-sm">

                            Dashboard
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

    {{-- HERO --}}
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 py-16">

        <div class="max-w-4xl mx-auto px-6 text-center">

            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">

                Selamat Datang di
                <span class="block mt-2">
                    Perpustakaan Digital
                </span>

            </h1>

            <p class="text-blue-100 text-lg mb-10">

                Temukan berbagai koleksi buku untuk mendukung kegiatan belajar dan literasi sekolah.

            </p>

            {{-- SEARCH --}}
            <form method="GET" action="/">

                <div class="bg-white p-2 rounded-2xl shadow-xl flex flex-col md:flex-row gap-2">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari judul buku..."
                           class="flex-1 px-5 py-3 rounded-xl border-0 focus:ring-0 text-gray-700">

                    <button type="submit"
                            class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition">

                        Cari

                    </button>

                </div>

            </form>

        </div>

    </section>

    {{-- CONTENT --}}
    <section class="py-12">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-8">

                <h2 class="text-3xl font-bold text-gray-800">

                    Katalog Buku

                </h2>

                <p class="text-gray-500 mt-1">

                    Jelajahi koleksi buku yang tersedia.

                </p>

            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @forelse($buku as $item)

                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 border">

                        {{-- COVER --}}
                        <div class="h-72 bg-gray-100 overflow-hidden">

                            @if($item->cover)

                                <img src="{{ asset('storage/'.$item->cover) }}"
                                     class="w-full h-full object-cover hover:scale-105 transition duration-500">

                            @else

                                <div class="w-full h-full flex items-center justify-center text-gray-400">

                                    Tidak Ada Cover

                                </div>

                            @endif

                        </div>

                        {{-- BODY --}}
                        <div class="p-5">

                            <h3 class="font-bold text-lg text-gray-800 line-clamp-2 min-h-[56px]">

                                {{ $item->judul }}

                            </h3>

                            <div class="mt-3 text-sm text-gray-500">

                                Kategori:
                                <span class="font-medium text-gray-700">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </span>

                            </div>

                            <div class="text-sm text-gray-500 mt-1">

                                Rak:
                                <span class="font-medium text-gray-700">
                                    {{ $item->rak->nama_rak ?? '-' }}
                                </span>

                            </div>

                            {{-- STATUS --}}
                            <div class="mt-4">

                                @if($item->stok > 0)

                                    <span class="inline-flex px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">

                                        Tersedia

                                    </span>

                                @else

                                    <span class="inline-flex px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">

                                        Stok Habis

                                    </span>

                                @endif

                            </div>

                            {{-- BUTTON --}}
                            <div class="mt-5">

                                <a href="{{ route('front.detail-buku', $item->id) }}"
                                   class="block text-center py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition">

                                    Detail Buku

                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full">

                        <div class="bg-white rounded-2xl p-10 text-center shadow-sm">

                            <div class="text-5xl mb-4">
                                📚
                            </div>

                            <h3 class="text-xl font-semibold text-gray-700">

                                Buku tidak ditemukan

                            </h3>

                            <p class="text-gray-500 mt-2">

                                Coba gunakan kata kunci yang berbeda.

                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

            {{-- PAGINATION --}}
            <div class="mt-10">

                {{ $buku->links() }}

            </div>

        </div>

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