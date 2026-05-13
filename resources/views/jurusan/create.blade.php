<x-app-layout>

    <x-slot name="header">
        Tambah Jurusan
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('jurusan.store') }}"
                      method="POST">

                    @csrf

                    <div class="mb-4">

                        <label>Nama Jurusan</label>

                        <input type="text"
                               name="nama_jurusan"
                               class="w-full border rounded p-2">

                        @error('nama_jurusan')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

                        Simpan

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>