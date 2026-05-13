<x-app-layout>

    <x-slot name="header">
        Katalog Buku
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white p-6 rounded shadow mb-6">

                <form action="{{ route('buku.katalog') }}"
                      method="GET">

                    <div class="flex gap-2">

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari judul, pengarang, penerbit, kode buku..."
                               class="w-full border rounded p-3">

                        <button type="submit"
                                class="bg-blue-500 text-white px-6 rounded">

                            Cari

                        </button>

                    </div>

                </form>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @forelse($buku as $item)

                <div class="bg-white rounded shadow overflow-hidden">

                    @if($item->cover)

                        <img src="{{ asset('storage/' . $item->cover) }}"
                             class="w-full h-72 object-cover">

                    @else

                        <div class="w-full h-72 bg-gray-200 flex items-center justify-center">

                            Tidak Ada Cover

                        </div>

                    @endif

                    <div class="p-4">

                        <h2 class="font-bold text-lg min-h-[60px]">
                            {{ $item->judul }}
                        </h2>

                        <p class="text-sm text-gray-600 mt-2">
                            {{ $item->pengarang }}
                        </p>

                        <div class="mt-3 text-sm space-y-1">

                            <p>
                                <span class="font-semibold">Kategori:</span>
                                {{ $item->kategori->nama_kategori }}
                            </p>

                            <p>
                                <span class="font-semibold">Rak:</span>
                                {{ $item->rak->nama_rak }}
                            </p>

                            <p>
                                <span class="font-semibold">Kode:</span>
                                {{ $item->kode_buku }}
                            </p>

                        </div>

                        <div class="mt-4">

                            <a href="{{ route('buku.show', $item->id) }}"
                               class="w-full inline-block text-center bg-blue-500 text-white px-4 py-2 rounded">

                                Detail Buku

                            </a>

                        </div>

                    </div>

                </div>

                @empty

                <div class="col-span-4 bg-white p-10 rounded shadow text-center">

                    Buku tidak ditemukan

                </div>

                @endforelse

            </div>

            <div class="mt-6">
                {{ $buku->links() }}
            </div>

        </div>

    </div>

</x-app-layout>