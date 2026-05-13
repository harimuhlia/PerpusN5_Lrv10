<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Total Buku --}}
                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-blue-500">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500">
                                Total Buku
                            </p>

                            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalBuku }}
                            </h2>
                        </div>

                        <div class="bg-blue-100 p-4 rounded-full">
                            📚
                        </div>

                    </div>

                </div>

                {{-- Total Member --}}
                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-green-500">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500">
                                Total Member
                            </p>

                            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalMember }}
                            </h2>
                        </div>

                        <div class="bg-green-100 p-4 rounded-full">
                            👨‍🎓
                        </div>

                    </div>

                </div>

                {{-- Total Peminjaman --}}
                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-yellow-500">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500">
                                Total Peminjaman
                            </p>

                            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalPinjam }}
                            </h2>
                        </div>

                        <div class="bg-yellow-100 p-4 rounded-full">
                            📖
                        </div>

                    </div>

                </div>

                {{-- Sedang Dipinjam --}}
                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-red-500">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500">
                                Sedang Dipinjam
                            </p>

                            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                                {{ $pinjamAktif }}
                            </h2>
                        </div>

                        <div class="bg-red-100 p-4 rounded-full">
                            ⏳
                        </div>

                    </div>

                </div>

            </div>

            {{-- MENU CEPAT --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">

                <a href="{{ route('buku.index') }}"
                   class="bg-white shadow rounded-2xl p-6 hover:bg-blue-50 transition">

                    <div class="text-4xl mb-3">
                        📚
                    </div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Data Buku
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data buku perpustakaan
                    </p>

                </a>

                <a href="{{ route('member.index') }}"
                   class="bg-white shadow rounded-2xl p-6 hover:bg-green-50 transition">

                    <div class="text-4xl mb-3">
                        👨‍🎓
                    </div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Data Member
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data anggota perpustakaan
                    </p>

                </a>

                <a href="{{ route('pinjam.index') }}"
                   class="bg-white shadow rounded-2xl p-6 hover:bg-yellow-50 transition">

                    <div class="text-4xl mb-3">
                        📖
                    </div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Data Peminjaman
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola transaksi peminjaman
                    </p>

                </a>

                <a href="{{ route('kategori.index') }}"
                   class="bg-white shadow rounded-2xl p-6 hover:bg-purple-50 transition">

                    <div class="text-4xl mb-3">
                        🗂️
                    </div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Kategori Buku
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola kategori buku
                    </p>

                </a>

            </div>

            {{-- PEMINJAMAN TERBARU --}}
            <div class="bg-white shadow rounded-2xl mt-8 overflow-hidden">

                <div class="p-6 border-b">

                    <h2 class="text-xl font-bold text-gray-800">
                        Peminjaman Terbaru
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Daftar transaksi terbaru perpustakaan
                    </p>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">
                                    Member
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">
                                    Buku
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">
                                    Jumlah
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">

                            @forelse($pinjamTerbaru as $item)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        {{ $item->user->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->buku->judul }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $item->jumlah }}
                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        @if($item->status == 'pending')

                                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                                Pending
                                            </span>

                                        @elseif($item->status == 'dipinjam')

                                            <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                                                Dipinjam
                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                                Dikembalikan
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Belum ada transaksi peminjaman

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>