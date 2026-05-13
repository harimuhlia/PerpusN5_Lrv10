<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Anggota
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">

                <div class="p-6 text-gray-900">

                    <h3 class="text-2xl font-bold mb-2">

                        Selamat Datang, {{ auth()->user()->name }}

                    </h3>

                    <p class="text-gray-600">

                        Anda login sebagai
                        <span class="font-semibold">
                            {{ auth()->user()->role }}
                        </span>

                    </p>

                </div>

            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                {{-- Dipinjam --}}
                <div class="bg-white shadow-sm rounded-lg p-6">

                    <h4 class="text-sm text-gray-500 uppercase">
                        Buku Dipinjam
                    </h4>

                    <div class="text-3xl font-bold text-blue-600 mt-2">

                        {{ $dipinjam }}

                    </div>

                </div>

                {{-- Dikembalikan --}}
                <div class="bg-white shadow-sm rounded-lg p-6">

                    <h4 class="text-sm text-gray-500 uppercase">
                        Buku Dikembalikan
                    </h4>

                    <div class="text-3xl font-bold text-green-600 mt-2">

                        {{ $dikembalikan }}

                    </div>

                </div>

                {{-- Denda --}}
                <div class="bg-white shadow-sm rounded-lg p-6">

                    <h4 class="text-sm text-gray-500 uppercase">
                        Total Denda
                    </h4>

                    <div class="text-3xl font-bold text-red-600 mt-2">

                        Rp {{ number_format($denda, 0, ',', '.') }}

                    </div>

                </div>

            </div>

            {{-- Menu --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                {{-- Katalog --}}
                <div class="bg-white shadow-sm rounded-lg p-6">

                    <h4 class="text-lg font-bold mb-2">
                        📚 Katalog Buku
                    </h4>

                    <p class="text-gray-600 mb-4">
                        Lihat daftar buku yang tersedia.
                    </p>

                    <a href="{{ route('katalog.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 transition">

                        Lihat Buku

                    </a>

                </div>

                {{-- Peminjaman --}}
                <div class="bg-white shadow-sm rounded-lg p-6">

                    <h4 class="text-lg font-bold mb-2">
                        📖 Peminjaman Saya
                    </h4>

                    <p class="text-gray-600 mb-4">
                        Lihat status peminjaman buku.
                    </p>

                    <a href="{{ route('pinjam.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 transition">

                        Lihat Peminjaman

                    </a>

                </div>

                {{-- Profil --}}
                <div class="bg-white shadow-sm rounded-lg p-6">

                    <h4 class="text-lg font-bold mb-2">
                        👤 Profil Saya
                    </h4>

                    <p class="text-gray-600 mb-4">
                        Kelola data akun Anda.
                    </p>

                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 transition">

                        Edit Profil

                    </a>

                </div>

            </div>

            {{-- Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 border-b border-gray-200">

                    <h3 class="text-xl font-bold text-gray-800">

                        Riwayat Peminjaman

                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Buku
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Tanggal
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse($pinjam as $item)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">

                                        <div class="font-semibold text-gray-800">

                                            {{ $item->buku->judul }}

                                        </div>

                                        <div class="text-sm text-gray-500">

                                            {{ $item->buku->pengarang }}

                                        </div>

                                    </td>

                                    <td class="px-6 py-4 text-center text-sm text-gray-700">

                                        {{ $item->tanggal_pinjam }}

                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        @if($item->status == 'pending')

                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">

                                                Pending

                                            </span>

                                        @elseif($item->status == 'dipinjam')

                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">

                                                Dipinjam

                                            </span>

                                        @else

                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">

                                                Dikembalikan

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Belum ada data peminjaman

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="p-6 border-t border-gray-200">

                    {{ $pinjam->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>