<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Trash Buku
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white p-6 rounded-lg shadow">

                {{-- Alert Success --}}
                @if(session('success'))

                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

                        {{ session('success') }}

                    </div>

                @endif

                {{-- Tombol Kembali --}}
                <div class="mb-4">

                    <a href="{{ route('buku.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">

                        ← Kembali

                    </a>

                </div>

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
                                    Pengarang
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
                                             class="w-20 h-28 object-cover rounded shadow mx-auto">

                                    @else

                                        <div class="w-20 h-28 bg-gray-200 rounded flex items-center justify-center text-sm text-gray-500 mx-auto">

                                            No Cover

                                        </div>

                                    @endif

                                </td>

                                {{-- Judul --}}
                                <td class="border p-3">

                                    <div class="font-semibold text-gray-800">
                                        {{ $item->judul }}
                                    </div>

                                </td>

                                {{-- Pengarang --}}
                                <td class="border p-3">

                                    {{ $item->pengarang }}

                                </td>

                                {{-- Aksi --}}
                                <td class="border p-3">

                                    <div class="flex justify-center gap-2 flex-wrap">

                                        {{-- Restore --}}
                                        <a href="{{ route('buku.restore', $item->id) }}"
                                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm shadow">

                                            Restore

                                        </a>

                                        {{-- Delete Permanen --}}
                                        <form action="{{ route('buku.forceDelete', $item->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Hapus permanen data?')"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm shadow">

                                                Delete Permanen

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center p-6 text-gray-500">

                                    Trash buku kosong

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="mt-6">

                    {{ $buku->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>