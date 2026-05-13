<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pinjaman Terhapus
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert --}}
            @if(session('success'))

                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">

                    {{ session('success') }}

                </div>

            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">

                {{-- Header --}}
                <div class="p-6 border-b flex justify-between items-center">

                    <h2 class="text-2xl font-bold text-gray-800">
                        Trashed Peminjaman
                    </h2>

                    <a href="{{ route('pinjam.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">

                        Kembali

                    </a>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Buku
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Peminjam
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse($pinjam as $item)

                                <tr>

                                    <td class="px-6 py-4 font-semibold">
                                        {{ $item->buku->judul }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->user->name }}
                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex gap-2 justify-center">

                                            {{-- Restore --}}
                                            <form action="{{ route('pinjam.restore', $item->id) }}"
                                                  method="POST">

                                                @csrf

                                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm">

                                                    Restore

                                                </button>

                                            </form>

                                            {{-- Force Delete --}}
                                            <form action="{{ route('pinjam.forceDelete', $item->id) }}"
                                                  method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button onclick="return confirm('Hapus permanen?')"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm">

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3"
                                        class="text-center p-6 text-gray-500">

                                        Tidak ada data terhapus

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="p-6">

                    {{ $pinjam->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>