<x-app-layout>

    <x-slot name="header">
        Master Kategori
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto">

            @if(session('success'))

                <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>

            @endif

            <div class="bg-white p-6 rounded shadow">

                <div class="flex justify-between items-center mb-4">

                    <h2 class="text-xl font-bold">
                        Data Kategori
                    </h2>

                    <div class="flex gap-2">

                        <a href="{{ route('kategori.trash') }}"
                           class="bg-gray-700 text-white px-4 py-2 rounded">

                            Trash

                        </a>

                        <a href="{{ route('kategori.create') }}"
                           class="bg-blue-500 text-white px-4 py-2 rounded">

                            + Tambah

                        </a>

                    </div>

                </div>

                <table class="w-full border">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border p-3">No</th>
                            <th class="border p-3">Nama Kategori</th>
                            <th class="border p-3">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($kategori as $item)

                        <tr>

                            <td class="border p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3">
                                {{ $item->nama_kategori }}
                            </td>

                            <td class="border p-3">

                                <div class="flex gap-2">

                                    <a href="{{ route('kategori.show', $item->id) }}"
                                       class="w-20 text-center bg-green-500 text-white px-3 py-2 rounded">

                                        Detail

                                    </a>

                                    <a href="{{ route('kategori.edit', $item->id) }}"
                                       class="w-20 text-center bg-yellow-500 text-white px-3 py-2 rounded">

                                        Edit

                                    </a>

                                    <form action="{{ route('kategori.destroy', $item->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Hapus data?')"
                                                class="w-20 bg-red-500 text-white px-3 py-2 rounded">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3"
                                class="text-center p-4">

                                Data kosong

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-4">
                    {{ $kategori->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>