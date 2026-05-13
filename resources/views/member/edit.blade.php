<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Member
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- ERROR --}}
            @if ($errors->any())

                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">

                    <ul class="list-disc pl-5 space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">

                {{-- HEADER --}}
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-8 py-8">

                    <div class="flex items-center gap-5">

                        <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-lg">

                            <span class="text-3xl font-bold text-orange-500">
                                {{ strtoupper(substr($member->name, 0, 1)) }}
                            </span>

                        </div>

                        <div class="text-white">

                            <h1 class="text-3xl font-bold">
                                {{ $member->name }}
                            </h1>

                            <p class="mt-1 text-orange-100">
                                ID Register :
                                <span class="font-semibold">
                                    {{ $member->id_register }}
                                </span>
                            </p>

                        </div>

                    </div>

                </div>

                {{-- FORM --}}
                <div class="p-8">

                    <form action="{{ route('member.update', $member->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- NAMA --}}
                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Nama Lengkap
                                </label>

                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $member->name) }}"
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">

                            </div>

                            {{-- EMAIL --}}
                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $member->email) }}"
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">

                            </div>

                            {{-- KELAS --}}
                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Kelas
                                </label>

                                <select name="kelas_id"
                                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">

                                    <option value="">
                                        -- Pilih Kelas --
                                    </option>

                                    @foreach($kelas as $item)

                                        <option value="{{ $item->id }}"
                                            {{ old('kelas_id', $member->kelas_id) == $item->id ? 'selected' : '' }}>

                                            {{ $item->nama_kelas }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            {{-- NO WA --}}
                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Nomor WhatsApp
                                </label>

                                <input type="text"
                                       name="no_wa"
                                       value="{{ old('no_wa', $member->no_wa) }}"
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">

                            </div>

                            {{-- PASSWORD --}}
                            <div class="md:col-span-2">

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Password Baru
                                </label>

                                <input type="password"
                                       name="password"
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">

                                <small class="text-gray-500">
                                    Kosongkan jika tidak ingin mengganti password
                                </small>

                            </div>

                            {{-- ALAMAT --}}
                            <div class="md:col-span-2">

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Alamat
                                </label>

                                <textarea name="alamat"
                                          rows="4"
                                          class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">{{ old('alamat', $member->alamat) }}</textarea>

                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="mt-8 flex flex-wrap gap-3">

                            <button type="submit"
                                    class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl shadow transition">

                                Update Member

                            </button>

                            <a href="{{ route('member.index') }}"
                               class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl shadow transition">

                                Kembali

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>