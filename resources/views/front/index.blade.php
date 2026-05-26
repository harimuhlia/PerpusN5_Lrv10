<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Perpustakaan Digital
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">

    {{-- NAVBAR --}}
<nav class="bg-white shadow">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-16">

            {{-- LOGO --}}
            <div>

                <h1 class="text-2xl font-bold text-blue-600">
                    Perpustakaan Digital
                </h1>

            </div>

            {{-- MENU --}}
            <div class="flex gap-3">

                @auth

                    <a href="{{ route('anggota.dashboard') }}"
                       class="inline-flex items-center px-5 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded-xl font-medium transition shadow-sm">

                        📚 Dashboard Anggota

                    </a>

                @else

                    <a href="{{ route('login') }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">

                        Login

                    </a>

                    <a href="{{ route('register') }}"
                       class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">

                        Register

                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>

    {{-- HERO --}}
    <section class="bg-blue-600 text-black py-16">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h2 class="text-5xl font-bold mb-4">
                Selamat Datang
            </h2>

            <p class="text-lg text-black-100 mb-8">
                Sistem Perpustakaan Digital Sekolah
            </p>

            <form method="GET"
                  action="/">

                <div class="max-w-2xl mx-auto flex gap-3">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari judul buku..."
                           class="w-full rounded-lg border-0 px-5 py-4 text-gray-700">

                    <button class="bg-white text-blue-600 px-6 rounded-lg font-bold">
                        Cari
                    </button>

                </div>

            </form>

        </div>

    </section>

    {{-- CONTENT --}}
    <section class="py-10">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-6">

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        Katalog Buku
                    </h2>

                    <p class="text-gray-500">
                        Daftar buku perpustakaan sekolah
                    </p>

                </div>

            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @forelse($buku as $item)

                    <div class="bg-white rounded-xl shadow overflow-hidden">

                        {{-- COVER --}}
                        <div class="h-64 bg-gray-200">

                            @if($item->cover)

                                <img src="{{ asset('storage/'.$item->cover) }}"
                                     class="w-full h-full object-cover">

                            @else

                                <div class="w-full h-full flex items-center justify-center text-gray-400">

                                    No Cover

                                </div>

                            @endif

                        </div>

                        {{-- BODY --}}
                        <div class="p-5">

                            <h3 class="font-bold text-lg mb-2 line-clamp-2">
                                {{ $item->judul }}
                            </h3>

                            <div class="text-sm text-gray-500 mb-2">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </div>

                            <div class="text-sm text-gray-500 mb-3">
                                Rak:
                                {{ $item->rak->nama_rak ?? '-' }}
                            </div>

                            {{-- STATUS --}}
                            @if($item->stok > 0)

                                <span class="inline-block px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full mb-4">
                                    Tersedia
                                </span>

                            @else

                                <span class="inline-block px-3 py-1 text-sm bg-red-100 text-red-700 rounded-full mb-4">
                                    Dipinjam
                                </span>

                            @endif

                            <div>

                                <a href="{{ route('front.detail-buku', $item->id) }}"
                                   class="block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg">

                                    Detail Buku

                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-4 bg-white rounded-xl p-10 text-center text-gray-500">

                        Buku tidak ditemukan

                    </div>

                @endforelse

            </div>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $buku->links() }}
            </div>

        </div>

    </section>

</body>

</html>