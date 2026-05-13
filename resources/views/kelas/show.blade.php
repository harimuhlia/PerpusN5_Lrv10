<x-app-layout>

    <x-slot name="header">
        Detail Kelas
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <div class="mb-4">

                    <label class="font-bold">
                        Jurusan
                    </label>

                    <p>
                        {{ $kela->jurusan->nama_jurusan }}
                    </p>

                </div>

                <div>

                    <label class="font-bold">
                        Nama Kelas
                    </label>

                    <p>
                        {{ $kela->nama_kelas }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>