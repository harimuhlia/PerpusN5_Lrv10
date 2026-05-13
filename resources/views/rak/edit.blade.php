<x-app-layout>

    <x-slot name="header">
        Edit Rak
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('rak.update', $rak->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label>Kode Rak</label>

                        <input type="text"
                               name="kode_rak"
                               value="{{ $rak->kode_rak }}"
                               class="w-full border rounded p-2">

                    </div>

                    <div class="mb-4">

                        <label>Nama Rak</label>

                        <input type="text"
                               name="nama_rak"
                               value="{{ $rak->nama_rak }}"
                               class="w-full border rounded p-2">

                    </div>

                    <div class="mb-4">

                        <label>Keterangan</label>

                        <textarea name="keterangan"
                                  class="w-full border rounded p-2">{{ $rak->keterangan }}</textarea>

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