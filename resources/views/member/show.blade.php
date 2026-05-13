<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Member
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">

                {{-- HEADER --}}
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-10">

                    <div class="flex items-center gap-6">

                        {{-- FOTO / ICON --}}
                        <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center shadow-lg">

                            <span class="text-4xl font-bold text-blue-600">
                                {{ strtoupper(substr($member->name, 0, 1)) }}
                            </span>

                        </div>

                        {{-- INFO --}}
                        <div class="text-white">

                            <h1 class="text-3xl font-bold">
                                {{ $member->name }}
                            </h1>

                            <p class="mt-1 text-blue-100">
                                ID Register :
                                <span class="font-semibold">
                                    {{ $member->id_register }}
                                </span>
                            </p>

                            <div class="mt-3">

                                <span class="px-4 py-1 bg-white/20 rounded-full text-sm">
                                    Member Perpustakaan
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="p-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- EMAIL --}}
                        <div class="bg-gray-50 rounded-xl p-5 border">

                            <p class="text-sm text-gray-500">
                                Email
                            </p>

                            <h3 class="mt-1 text-lg font-semibold text-gray-800">
                                {{ $member->email }}
                            </h3>

                        </div>

                        {{-- KELAS --}}
                        <div class="bg-gray-50 rounded-xl p-5 border">

                            <p class="text-sm text-gray-500">
                                Kelas
                            </p>

                            <h3 class="mt-1 text-lg font-semibold text-gray-800">
                                {{ $member->kelas->nama_kelas ?? '-' }}
                            </h3>

                        </div>

                        {{-- NO WA --}}
                        <div class="bg-gray-50 rounded-xl p-5 border">

                            <p class="text-sm text-gray-500">
                                Nomor WhatsApp
                            </p>

                            <h3 class="mt-1 text-lg font-semibold text-gray-800">
                                {{ $member->no_wa ?? '-' }}
                            </h3>

                        </div>

                        {{-- ROLE --}}
                        <div class="bg-gray-50 rounded-xl p-5 border">

                            <p class="text-sm text-gray-500">
                                Role
                            </p>

                            <h3 class="mt-1">
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                    {{ ucfirst($member->role) }}
                                </span>
                            </h3>

                        </div>

                    </div>

                    {{-- ALAMAT --}}
                    <div class="mt-6 bg-gray-50 rounded-xl p-5 border">

                        <p class="text-sm text-gray-500">
                            Alamat
                        </p>

                        <p class="mt-2 text-gray-800 leading-relaxed">
                            {{ $member->alamat ?? '-' }}
                        </p>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-8 flex flex-wrap gap-3">

                        <a href="{{ route('member.index') }}"
                           class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl shadow transition">

                            Kembali

                        </a>

                        <a href="{{ route('member.edit', $member->id) }}"
                           class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl shadow transition">

                            Edit Member

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>