<x-app-layout>

    <x-slot name="header">
        Edit Jurusan
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('jurusan.update', $jurusan->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label>Nama Jurusan</label>

                        <input type="text"
                               name="nama_jurusan"
                               value="{{ $jurusan->nama_jurusan }}"
                               class="w-full border rounded p-2">

                    </div>

                    <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">

                        Update

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>