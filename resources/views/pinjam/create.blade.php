<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Pinjam Buku
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            {{-- ERROR --}}
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">

                    {{-- COVER --}}
                    <div>
                        @if($buku->cover)
                            <img src="{{ asset('storage/' . $buku->cover) }}" class="w-full rounded-lg shadow">
                        @else
                            <div class="w-full h-96 bg-gray-200 flex items-center justify-center rounded-lg">
                                Tidak Ada Cover
                            </div>
                        @endif
                    </div>

                    {{-- DETAIL --}}
                    <div class="md:col-span-2">

                        <h2 class="text-2xl font-bold">{{ $buku->judul }}</h2>

                        <div class="mt-4 space-y-2 text-sm">

                            <p><b>Pengarang:</b> {{ $buku->pengarang }}</p>
                            <p><b>Penerbit:</b> {{ $buku->penerbit }}</p>
                            <p><b>Tahun:</b> {{ $buku->tahun_terbit }}</p>
                            <p><b>Kategori:</b> {{ $buku->kategori->nama_kategori }}</p>
                            <p><b>Rak:</b> {{ $buku->rak->nama_rak }}</p>

                            <p>
                                <b>Stok:</b>
                                @if($buku->stok > 0)
                                    <span class="text-green-600">{{ $buku->stok }} tersedia</span>
                                @else
                                    <span class="text-red-600">Habis</span>
                                @endif
                            </p>

                        </div>

                        {{-- FORM --}}
                        @if($buku->stok > 0)

                            <form action="{{ route('pinjam.store') }}" method="POST" class="mt-6">
                                @csrf

                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                                {{-- JUMLAH --}}
                                <div class="mb-4">
                                    <label class="block font-semibold mb-1">Jumlah Buku</label>
                                    <input type="number"
                                           name="jumlah"
                                           min="1"
                                           max="{{ $buku->stok }}"
                                           value="1"
                                           class="w-full border rounded-lg p-3">
                                </div>

                                {{-- DURASI --}}
                                <div>
                                    <label class="block font-semibold mb-1">Durasi (Hari)</label>
                                    <input type="number"
                                           name="durasi_pinjam"
                                           min="1"
                                           max="30"
                                           value="3"
                                           class="w-full border rounded-lg p-3">
                                </div>

                                <div class="mt-6 flex gap-3">
                                    <button class="bg-green-500 text-white px-6 py-3 rounded-lg">
                                        Ajukan
                                    </button>

                                    <a href="{{ route('katalog.index') }}"
                                       class="bg-gray-500 text-white px-6 py-3 rounded-lg">
                                        Kembali
                                    </a>
                                </div>

                            </form>

                        @else
                            <button disabled class="mt-6 bg-gray-400 text-white px-6 py-3 rounded-lg">
                                Stok Habis
                            </button>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>