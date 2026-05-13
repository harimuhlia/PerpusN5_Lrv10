<x-app-layout>

    <x-slot name="header">
        Edit Kelas
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('kelas.update', $kela->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label>Jurusan</label>

                        <select name="jurusan_id"
                                class="w-full border rounded p-2">

                            @foreach($jurusan as $item)

                                <option value="{{ $item->id }}"
                                    {{ $kela->jurusan_id == $item->id ? 'selected' : '' }}>

                                    {{ $item->nama_jurusan }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label>Nama Kelas</label>

                        <input type="text"
                               name="nama_kelas"
                               value="{{ $kela->nama_kelas }}"
                               class="w-full border rounded p-2">

                    </div>

                    <button type="submit"
                            class="bg-yellow-500 text-white px-4 py-2 rounded">

                        Update

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>