<x-app-layout>

    <x-slot name="header">
        Master Rak
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
                        Data Rak
                    </h2>

                    <div class="flex gap-2">

                        <a href="{{ route('rak.trash') }}"
                           class="bg-gray-700 text-white px-4 py-2 rounded">

                            Trash

                        </a>

                        <a href="{{ route('rak.create') }}"
                           class="bg-blue-500 text-white px-4 py-2 rounded">

                            + Tambah

                        </a>

                    </div>

                </div>

                <table class="w-full border">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border p-3">No</th>
                            <th class="border p-3">Kode Rak</th>
                            <th class="border p-3">Nama Rak</th>
                            <th class="border p-3">Keterangan</th>
                            <th class="border p-3">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rak as $item)

                        <tr>

                            <td class="border p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3">
                                {{ $item->kode_rak }}
                            </td>

                            <td class="border p-3">
                                {{ $item->nama_rak }}
                            </td>

                            <td class="border p-3">
                                {{ $item->keterangan }}
                            </td>

                            <td class="border p-3">

                                <div class="flex gap-2">

                                    <a href="{{ route('rak.show', $item->id) }}"
                                       class="w-20 text-center bg-green-500 text-white px-3 py-2 rounded">

                                        Detail

                                    </a>

                                    <a href="{{ route('rak.edit', $item->id) }}"
                                       class="w-20 text-center bg-yellow-500 text-white px-3 py-2 rounded">

                                        Edit

                                    </a>

                                    <form action="{{ route('rak.destroy', $item->id) }}"
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

                            <td colspan="5"
                                class="text-center p-4">

                                Data kosong

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-4">
                    {{ $rak->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>