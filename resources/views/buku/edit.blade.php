<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Buku
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white p-6 rounded-lg shadow">

                {{-- Error --}}
                @if ($errors->any())

                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">

                        <ul class="list-disc pl-5">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('buku.update', $buku->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Kategori --}}
                        <div>
                            <label class="block mb-1 font-semibold">Kategori</label>

                            <select name="kategori_id"
                                    class="w-full border rounded-lg p-2">

                                @foreach($kategori as $item)

                                    <option value="{{ $item->id }}"
                                        {{ $buku->kategori_id == $item->id ? 'selected' : '' }}>

                                        {{ $item->nama_kategori }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- Rak --}}
                        <div>
                            <label class="block mb-1 font-semibold">Rak</label>

                            <select name="rak_id"
                                    class="w-full border rounded-lg p-2">

                                @foreach($rak as $item)

                                    <option value="{{ $item->id }}"
                                        {{ $buku->rak_id == $item->id ? 'selected' : '' }}>

                                        {{ $item->nama_rak }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- Kode Buku --}}
                        <div>
                            <label class="block mb-1 font-semibold">Kode Buku</label>

                            <input type="text"
                                   name="kode_buku"
                                   value="{{ $buku->kode_buku }}"
                                   class="w-full border rounded-lg p-2">
                        </div>

                        {{-- Judul --}}
                        <div>
                            <label class="block mb-1 font-semibold">Judul Buku</label>

                            <input type="text"
                                   name="judul"
                                   value="{{ $buku->judul }}"
                                   class="w-full border rounded-lg p-2">
                        </div>

                        {{-- Pengarang --}}
                        <div>
                            <label class="block mb-1 font-semibold">Pengarang</label>

                            <input type="text"
                                   name="pengarang"
                                   value="{{ $buku->pengarang }}"
                                   class="w-full border rounded-lg p-2">
                        </div>

                        {{-- Penerbit --}}
                        <div>
                            <label class="block mb-1 font-semibold">Penerbit</label>

                            <input type="text"
                                   name="penerbit"
                                   value="{{ $buku->penerbit }}"
                                   class="w-full border rounded-lg p-2">
                        </div>

                        {{-- Tahun --}}
                        <div>
                            <label class="block mb-1 font-semibold">Tahun Terbit</label>

                            <input type="number"
                                   name="tahun_terbit"
                                   value="{{ $buku->tahun_terbit }}"
                                   class="w-full border rounded-lg p-2">
                        </div>

                        {{-- Stok (FIXED POSITION & AMAN) --}}
                        <div>
                            <label class="block mb-1 font-semibold">Stok</label>

                            <input type="number"
                                   name="stok"
                                   value="{{ old('stok', $buku->stok) }}"
                                   min="0"
                                   class="w-full border rounded-lg p-2">
                        </div>

                        {{-- Cover --}}
                        <div>
                            <label class="block mb-1 font-semibold">Cover Buku</label>

                            <input type="file"
                                   name="cover"
                                   class="w-full border rounded-lg p-2 bg-white">
                        </div>

                    </div>

                    {{-- Preview Cover --}}
                    @if($buku->cover)

                        <div class="mt-4">

                            <p class="mb-2 font-semibold">Cover Saat Ini:</p>

                            <img src="{{ asset('storage/' . $buku->cover) }}"
                                 class="w-40 rounded shadow">

                        </div>

                    @endif

                    {{-- Deskripsi --}}
                    <div class="mt-4">

                        <label class="block mb-1 font-semibold">Deskripsi</label>

                        <textarea name="deskripsi"
                                  rows="5"
                                  class="w-full border rounded-lg p-2">{{ $buku->deskripsi }}</textarea>

                    </div>

                    {{-- Button --}}
                    <div class="mt-6 flex gap-3">

                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg">

                            Update

                        </button>

                        <a href="{{ route('buku.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>