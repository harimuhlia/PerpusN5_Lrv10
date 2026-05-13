<x-app-layout>

    <x-slot name="header">
        Detail Rak
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <div class="mb-4">

                    <label class="font-bold">
                        Kode Rak
                    </label>

                    <p>
                        {{ $rak->kode_rak }}
                    </p>

                </div>

                <div class="mb-4">

                    <label class="font-bold">
                        Nama Rak
                    </label>

                    <p>
                        {{ $rak->nama_rak }}
                    </p>

                </div>

                <div>

                    <label class="font-bold">
                        Keterangan
                    </label>

                    <p>
                        {{ $rak->keterangan }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>