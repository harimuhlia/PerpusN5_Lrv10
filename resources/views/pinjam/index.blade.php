<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Peminjaman Buku
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

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                {{-- HEADER --}}
                <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Data Peminjaman
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Daftar peminjaman buku perpustakaan
                        </p>
                    </div>

                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('pinjam.trashed') }}"
                           class="px-4 py-2 bg-red-500 text-white text-xs font-semibold rounded hover:bg-red-600">
                            Trash
                        </a>
                    @endif

                </div>

                {{-- SEARCH --}}
                <div class="p-6 border-b bg-gray-50">

                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari Nama / Judul Buku / Kelas"
                               class="border rounded-lg p-2 w-full">

                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Search
                        </button>

                    </form>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Buku</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Durasi</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Denda</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse($pinjam as $item)

                                <tr>

                                    {{-- BUKU --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">

                                            @if($item->buku->cover)
                                                <img src="{{ asset('storage/' . $item->buku->cover) }}"
                                                     class="w-16 h-20 object-cover rounded-lg">
                                            @else
                                                <div class="w-16 h-20 bg-gray-200 flex items-center justify-center text-xs">
                                                    No Cover
                                                </div>
                                            @endif

                                            <div>
                                                <div class="font-semibold">
                                                    {{ $item->buku->judul }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $item->buku->pengarang }}
                                                </div>
                                            </div>

                                        </div>
                                    </td>

                                    {{-- PEMINJAM --}}
                                    <td class="px-6 py-4 text-sm">
                                        {{ $item->user->name }} <br>
                                        <span class="text-xs text-gray-500">
                                            {{ $item->user->id_register ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- KELAS --}}
                                    <td class="px-6 py-4 text-sm">
                                        {{ $item->user->kelas->nama_kelas ?? '-' }}
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td class="px-6 py-4 text-sm">
                                        <div><b>Pinjam:</b> {{ $item->tanggal_pinjam }}</div>
                                        <div><b>Kembali:</b> {{ $item->tanggal_kembali }}</div>
                                    </td>

                                    {{-- DURASI --}}
                                    <td class="px-6 py-4 text-center">
                                        {{ $item->durasi_pinjam }} Hari
                                    </td>

                                    {{-- JUMLAH --}}
                                    <td class="px-6 py-4 text-center">
                                        {{ $item->jumlah }}
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-6 py-4 text-center">

                                        @if($item->status == 'pending')
                                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                                Pending
                                            </span>

                                        @elseif($item->status == 'dipinjam')
                                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                                Dipinjam
                                            </span>

                                        @elseif($item->status == 'dikembalikan')
                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                                Dikembalikan
                                            </span>

                                        @elseif($item->status == 'dibatalkan')
                                            <span class="px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-700">
                                                Dibatalkan
                                            </span>
                                        @endif

                                    </td>

                                    {{-- DENDA --}}
                                    <td class="px-6 py-4 text-center">

                                        @if($item->denda > 0)
                                            <span class="text-red-600 font-bold">
                                                Rp {{ number_format($item->denda, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-4 text-center">

                                        <div class="flex flex-col gap-2">

                                            <a href="{{ route('pinjam.show', $item->id) }}"
                                               class="px-3 py-2 bg-blue-500 text-white text-xs rounded">
                                                Detail
                                            </a>

                                            {{-- 🔥 TAMBAHAN: BATAL (BISA ADMIN & USER, HANYA PENDING) --}}
                                            @if($item->status == 'pending')
                                                <form action="{{ route('pinjam.batal', $item->id) }}"
                                                      method="POST">

                                                    @csrf
                                                    @method('PUT')

                                                    <button type="submit"
                                                            onclick="return confirm('Batalkan peminjaman ini?')"
                                                            class="px-3 py-2 bg-gray-500 text-white text-xs rounded hover:bg-gray-600 w-full">

                                                        Batal

                                                    </button>

                                                </form>
                                            @endif

                                            {{-- SETUJUI --}}
                                            @if(Auth::user()->role == 'admin' && $item->status == 'pending')

                                                <form action="{{ route('pinjam.setujui', $item->id) }}"
                                                      method="POST">

                                                    @csrf
                                                    @method('PUT')

                                                    <button type="submit"
                                                            onclick="return confirm('Setujui peminjaman ini?')"
                                                            class="w-full px-3 py-2 bg-green-500 text-white text-xs rounded hover:bg-green-600">

                                                        Setujui

                                                    </button>

                                                </form>

                                            @endif

                                            {{-- KEMBALIKAN --}}
                                            @if(Auth::user()->role == 'admin' && $item->status == 'dipinjam')

                                                <form action="{{ route('pinjam.kembalikan', $item->id) }}"
                                                      method="POST">

                                                    @csrf
                                                    @method('PUT')

                                                    <button type="submit"
                                                            onclick="return confirm('Buku sudah dikembalikan?')"
                                                            class="w-full px-3 py-2 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600">

                                                        Kembalikan

                                                    </button>

                                                </form>

                                            @endif

                                            {{-- HAPUS --}}
                                            @if(Auth::user()->role == 'admin')

                                                <form action="{{ route('pinjam.destroy', $item->id) }}"
                                                      method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            onclick="return confirm('Hapus data ini?')"
                                                            class="w-full px-3 py-2 bg-red-500 text-white text-xs rounded hover:bg-red-600">

                                                        Hapus

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-10 text-center text-gray-500">
                                        Belum ada data peminjaman
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="p-6 border-t">
                    {{ $pinjam->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>