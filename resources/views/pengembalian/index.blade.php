<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Pengembalian Buku
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FORM SEARCH --}}
            <div class="bg-white rounded-2xl shadow p-6 mb-6">

                <form action="{{ route('pengembalian.cari') }}"
                      method="POST">

                    @csrf

                    <div class="flex gap-3">

                        <input type="text"
                               name="keyword"
                               placeholder="Masukkan ID Register / Nama Member"
                               class="w-full border rounded-xl p-3 focus:ring focus:ring-blue-200"
                               required>

                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 rounded-xl">

                            Cari

                        </button>

                    </div>

                </form>

            </div>

            {{-- DATA MEMBER --}}
            @isset($member)

                <div class="bg-white rounded-2xl shadow p-6 mb-6">

                    <h2 class="text-xl font-bold mb-4">
                        Detail Member
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <p class="text-sm text-gray-500">
                                ID Register
                            </p>

                            <p class="font-semibold">
                                {{ $member->id_register }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Nama
                            </p>

                            <p class="font-semibold">
                                {{ $member->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Kelas
                            </p>

                            <p class="font-semibold">
                                {{ $member->kelas->nama_kelas ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                No WA
                            </p>

                            <p class="font-semibold">
                                {{ $member->no_wa }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- DATA PINJAM --}}
                <div class="bg-white rounded-2xl shadow overflow-hidden">

                    <div class="p-6 border-b">

                        <h2 class="text-xl font-bold">
                            Buku Yang Dipinjam
                        </h2>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Buku
                                    </th>

                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">
                                        Jumlah
                                    </th>

                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">
                                        Tanggal
                                    </th>

                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">
                                        Denda
                                    </th>

                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">

                                @forelse($pinjam as $item)

                                    @php

                                        $telat = \Carbon\Carbon::parse($item->tanggal_kembali)
                                            ->diffInDays(now(), false);

                                        $denda = $telat > 0 ? $telat * 1000 : 0;

                                    @endphp

                                    <tr>

                                        <td class="px-6 py-4">

                                            <div class="font-semibold">
                                                {{ $item->buku->judul }}
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $item->buku->pengarang }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            {{ $item->jumlah }}
                                        </td>

                                        <td class="px-6 py-4 text-center text-sm">

                                            <div>
                                                Pinjam:
                                                {{ $item->tanggal_pinjam }}
                                            </div>

                                            <div class="mt-1">
                                                Kembali:
                                                {{ $item->tanggal_kembali }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4 text-center">

                                            @if($denda > 0)

                                                <span class="text-red-600 font-bold">
                                                    Rp {{ number_format($denda, 0, ',', '.') }}
                                                </span>

                                            @else

                                                <span class="text-green-600 font-semibold">
                                                    Tidak Ada
                                                </span>

                                            @endif

                                        </td>

                                        <td class="px-6 py-4 text-center">

                                            <form action="{{ route('pengembalian.proses', $item->id) }}"
                                                  method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button type="submit"
                                                        onclick="return confirm('Proses pengembalian buku ini?')"
                                                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">

                                                    Kembalikan

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5"
                                            class="px-6 py-10 text-center text-gray-500">

                                            Tidak ada buku yang sedang dipinjam

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            @endisset

        </div>

    </div>

</x-app-layout>