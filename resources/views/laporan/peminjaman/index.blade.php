<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Peminjaman
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow overflow-hidden">

                {{-- HEADER --}}
                <div class="p-6 border-b flex justify-between items-center">

                    <div>
                        <h2 class="text-2xl font-bold">
                            Laporan Peminjaman
                        </h2>

                        <p class="text-sm text-gray-500">
                            Data laporan peminjaman buku
                        </p>
                    </div>

                    <div class="flex gap-2">

                        <a href="{{ route('laporan.peminjaman.pdf', request()->all()) }}"
                           target="_blank"
                           class="px-4 py-2 bg-red-500 text-white rounded-lg">
                            PDF
                        </a>

                        <a href="{{ route('laporan.peminjaman.excel', request()->all()) }}"
                           class="px-4 py-2 bg-green-500 text-white rounded-lg">
                            Excel
                        </a>

                    </div>

                </div>

                {{-- FILTER --}}
                <div class="p-6 border-b">

                    <form method="GET">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- SEARCH --}}
                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Cari Member
                                </label>

                                <input type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nama / ID Register"
                                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">

                            </div>

                            {{-- STATUS --}}
                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Status
                                </label>

                                <select name="status"
                                        class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option value="pending"
                                        {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="dipinjam"
                                        {{ request('status') == 'dipinjam' ? 'selected' : '' }}>
                                        Dipinjam
                                    </option>

                                    <option value="dikembalikan"
                                        {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                                        Dikembalikan
                                    </option>

                                </select>

                            </div>

                            {{-- TANGGAL AWAL --}}
                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Awal
                                </label>

                                <input type="date"
                                    name="tanggal_awal"
                                    value="{{ request('tanggal_awal') }}"
                                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">

                            </div>

                            {{-- TANGGAL AKHIR --}}
                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Akhir
                                </label>

                                <input type="date"
                                    name="tanggal_akhir"
                                    value="{{ request('tanggal_akhir') }}"
                                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">

                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="mt-6 flex flex-wrap items-center gap-4">

                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition shadow-sm">

                                Search

                            </button>

                            <a href="{{ route('laporan.peminjaman') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition shadow-sm">

                                Reset

                            </a>

                        </div>

                    </form>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-3 text-left">
                                    Member
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Buku
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Tanggal
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Denda
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">

                            @forelse($laporan as $item)

                                <tr>

                                    <td class="px-6 py-4">

                                        <div class="font-semibold">
                                            {{ $item->user->name ?? '-' }}
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ $item->user->id_register ?? '-' }}
                                        </div>

                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->buku->judul ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm">

                                        <div>
                                            Pinjam:
                                            {{ $item->tanggal_pinjam }}
                                        </div>

                                        <div>
                                            Kembali:
                                            {{ $item->tanggal_kembali }}
                                        </div>

                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ ucfirst($item->status) }}
                                    </td>

                                    <td class="px-6 py-4 text-center text-red-600 font-bold">

                                        Rp {{ number_format($item->denda, 0, ',', '.') }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Data kosong

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="p-6 border-t">
                    {{ $laporan->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>