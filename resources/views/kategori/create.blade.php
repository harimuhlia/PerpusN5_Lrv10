<x-app-layout>

    <x-slot name="header">
        Tambah Kategori
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('kategori.store') }}"
                      method="POST">

                    @csrf

                    <div class="mb-4">

                        <label>Nama Kategori</label>

                        <input type="text"
                               name="nama_kategori"
                               class="w-full border rounded p-2">

                    </div>

                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded">

                        Simpan

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>