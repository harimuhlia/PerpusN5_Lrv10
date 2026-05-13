<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Master Buku
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white p-6 rounded-lg shadow">

                {{-- Header Action --}}
                <div class="flex justify-between items-center mb-6">

                    <h2 class="text-2xl font-bold text-gray-800">
                        Data Buku
                    </h2>

                    <div class="flex gap-3">
                        <form action="{{ route('buku.import') }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="flex gap-2">

                            @csrf

                            <input type="file"
                                name="file"
                                required
                                class="border rounded-lg px-3 py-2">

                            <button class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            + Import Excel
                            </button>

                        </form>

                        <a href="{{ route('buku.create') }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">

                            + Tambah Buku

                        </a>
                        <a href="{{ route('buku.export') }}"
                        class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                            Export Excel
                        </a>

                        
                        <a href="{{ route('buku.trash') }}"
                           class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">

                            Trash

                        </a>

                    </div>

                </div>

                {{-- Search --}}
                <div class="mb-6">

                    <form action="{{ route('buku.index') }}"
                          method="GET">

                        <div class="flex gap-3">

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

                {{-- Alert Success --}}
                @if(session('success'))

                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

                        {{ session('success') }}

                    </div>

                @endif

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full border border-gray-200">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border p-3 text-center">
                                    Cover
                                </th>

                                <th class="border p-3 text-left">
                                    Judul
                                </th>

                                <th class="border p-3 text-left">
                                    Kategori
                                </th>

                                <th class="border p-3 text-left">
                                    Stok
                                </th>

                                <th class="border p-3 text-left">
                                    Rak
                                </th>

                                <th class="border p-3 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($buku as $item)

                            <tr class="hover:bg-gray-50">

                                {{-- Cover --}}
                                <td class="border p-3 text-center">

                                    @if($item->cover)

                                        <img src="{{ asset('storage/' . $item->cover) }}"
                                             class="w-20 h-28 object-cover rounded mx-auto shadow">

                                    @else

                                        <div class="w-20 h-28 bg-gray-200 rounded flex items-center justify-center text-sm text-gray-500 mx-auto">

                                            No Cover

                                        </div>

                                    @endif

                                </td>

                                {{-- Judul --}}
                                <td class="border p-3">

                                    <div class="font-semibold">
                                        {{ $item->judul }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $item->pengarang }}
                                    </div>

                                </td>

                                {{-- Kategori --}}
                                <td class="border p-3">

                                    {{ $item->kategori->nama_kategori }}

                                </td>

                                {{-- Stok --}}
                                <td class="border p-3">

                                    {{ $item->stok }}

                                </td>

                                {{-- Rak --}}
                                <td class="border p-3">

                                    {{ $item->rak->nama_rak }}

                                </td>

                                {{-- Aksi --}}
                                <td class="border p-3">

                                    <div class="flex justify-center gap-2 flex-wrap">

                                        <a href="{{ route('buku.show', $item->id) }}"
                                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">

                                            Detail

                                        </a>

                                        <a href="{{ route('buku.edit', $item->id) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">

                                            Edit

                                        </a>

                                        <form action="{{ route('buku.destroy', $item->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Hapus data?')"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center p-6 text-gray-500">

                                    Data buku masih kosong

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="mt-6">

                    {{ $buku->appends(request()->query())->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>