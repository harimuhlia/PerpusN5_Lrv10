<x-app-layout>

    <x-slot name="header">
        Trash Rak
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <div class="mb-4">

                    <a href="{{ route('rak.index') }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded">

                        Kembali

                    </a>

                </div>

                <table class="w-full border">

                    <thead>

                        <tr>

                            <th class="border p-3">No</th>
                            <th class="border p-3">Kode Rak</th>
                            <th class="border p-3">Nama Rak</th>
                            <th class="border p-3">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($trash as $item)

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

                                <div class="flex gap-2">

                                    <a href="{{ route('rak.restore', $item->id) }}"
                                       class="w-24 text-center bg-green-500 text-white px-3 py-2 rounded">

                                        Restore

                                    </a>

                                    <form action="{{ route('rak.forceDelete', $item->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="w-32 bg-red-500 text-white px-3 py-2 rounded">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4"
                                class="text-center p-4">

                                Trash kosong

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>