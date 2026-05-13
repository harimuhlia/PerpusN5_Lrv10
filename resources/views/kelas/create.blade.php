<x-app-layout>

    <x-slot name="header">
        Tambah Kelas
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('kelas.store') }}"
                      method="POST">

                    @csrf

                    <div class="mb-4">

                        <label>Jurusan</label>

                        <select name="jurusan_id"
                                class="w-full border rounded p-2">

                            <option value="">
                                -- Pilih Jurusan --
                            </option>

                            @foreach($jurusan as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->nama_jurusan }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label>Nama Kelas</label>

                        <input type="text"
                               name="nama_kelas"
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