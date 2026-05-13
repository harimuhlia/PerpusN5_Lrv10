<x-app-layout>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            {{-- ALERT ERROR VALIDASI --}}
            @if ($errors->any())

            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-4 rounded-lg">

            <div class="font-bold mb-2">
            Terjadi Kesalahan:
            </div>

            <ul class="list-disc pl-5 space-y-1">

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

            </ul>

            </div>

            @endif

        {{-- ALERT GAGAL --}}
        @if(session('error'))

        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-4 rounded-lg">

        {{ session('error') }}

        </div>

        @endif

        <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-2xl font-bold mb-6">
        Tambah Member
        </h2>

        <form action="{{ route('member.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- NAMA --}}
        <div>

        <label class="block mb-2 font-semibold">
        Nama
        </label>

        <input type="text"
        name="name"
        value="{{ old('name') }}"
        class="w-full border rounded-lg p-3 focus:ring focus:ring-green-200">

        </div>

        {{-- EMAIL --}}
        <div>

        <label class="block mb-2 font-semibold">
        Email
        </label>

        <input type="email"
        name="email"
        value="{{ old('email') }}"
        class="w-full border rounded-lg p-3 focus:ring focus:ring-green-200">

        </div>

        {{-- PASSWORD --}}
        <div>

        <label class="block mb-2 font-semibold">
        Password
        </label>

        <input type="password"
        name="password"
        class="w-full border rounded-lg p-3 focus:ring focus:ring-green-200">

        <small class="text-gray-500">
        Minimal 6 karakter
        </small>

        </div>

        {{-- KELAS --}}
        <div>

        <label class="block mb-2 font-semibold">
        Kelas
        </label>

        <select name="kelas_id"
        class="w-full border rounded-lg p-3 focus:ring focus:ring-green-200">

        <option value="">
        -- Pilih Kelas --
        </option>

        @foreach($kelas as $k)

        <option value="{{ $k->id }}"
        {{ old('kelas_id') == $k->id ? 'selected' : '' }}>

        {{ $k->nama_kelas }}

        </option>

        @endforeach

        </select>

        </div>

        {{-- NO WA --}}
        <div>

        <label class="block mb-2 font-semibold">
        No WA
        </label>

        <input type="text"
        name="no_wa"
        value="{{ old('no_wa') }}"
        class="w-full border rounded-lg p-3 focus:ring focus:ring-green-200">

        </div>

        {{-- ALAMAT --}}
        <div class="md:col-span-2">

        <label class="block mb-2 font-semibold">
        Alamat
        </label>

        <textarea name="alamat"
        rows="4"
        class="w-full border rounded-lg p-3 focus:ring focus:ring-green-200">{{ old('alamat') }}</textarea>

        </div>

        </div>

        <div class="mt-6 flex gap-3">

        <button type="submit"
        class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition">

        Simpan

        </button>

        <a href="{{ route('member.index') }}"
        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition">

        Kembali

        </a>

        </div>

        </form>

        </div>

        </div>

    </div>

</x-app-layout>