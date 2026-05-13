<x-app-layout>

    <x-slot name="header">
        Detail Jurusan
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <h2 class="text-2xl font-bold">
                    {{ $jurusan->nama_jurusan }}
                </h2>

            </div>

        </div>

    </div>

</x-app-layout>