<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Member
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                {{-- HEADER --}}
                <div class="p-6 border-b flex justify-between items-center">

                    <div>
                        <h2 class="text-2xl font-bold">Data Member</h2>
                        <p class="text-sm text-gray-500">
                            Daftar anggota perpustakaan
                        </p>
                    </div>

                    <div class="flex gap-2">

                        {{-- CETAK MASAL (FIXED) --}}
                        <form action="{{ route('member.cetakMasal') }}" method="POST" target="_blank">
                            @csrf

                            @foreach($member as $item)
                                <input type="hidden" name="member_ids[]" value="{{ $item->id }}">
                            @endforeach

                            <button type="submit"
                                class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600">
                                Cetak Masal
                            </button>
                        </form>

                        <a href="{{ route('member.create') }}"
                           class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                            Tambah
                        </a>

                        <a href="{{ route('member.trash') }}"
                           class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Trash
                        </a>

                    </div>

                </div>

                {{-- SEARCH --}}
                <div class="p-6 border-b">

                    <form method="GET" action="{{ route('member.index') }}">

                        <div class="flex gap-3">

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama / ID Register / WA"
                                   class="w-full border rounded-lg px-4 py-2">

                            <button class="px-6 bg-blue-500 text-white rounded-lg">
                                Cari
                            </button>

                        </div>

                    </form>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>
                                <th class="px-6 py-3 text-left">ID Register</th>
                                <th class="px-6 py-3 text-left">Nama</th>
                                <th class="px-6 py-3 text-left">Kelas</th>
                                <th class="px-6 py-3 text-left">WA</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">

                            @forelse($member as $item)

                                <tr>

                                    <td class="px-6 py-4">
                                        {{ $item->id_register }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->kelas->nama_kelas ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->no_wa }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->email }}
                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex justify-center gap-2">

                                            {{-- CETAK INDIVIDU --}}
                                            <a href="{{ route('member.kartu', $item->id) }}"
                                               target="_blank"
                                               class="px-3 py-2 bg-green-600 text-white rounded">
                                                Cetak
                                            </a>

                                            <a href="{{ route('member.show', $item->id) }}"
                                               class="px-3 py-2 bg-blue-500 text-white rounded">
                                                Detail
                                            </a>

                                            <a href="{{ route('member.edit', $item->id) }}"
                                               class="px-3 py-2 bg-yellow-500 text-white rounded">
                                                Edit
                                            </a>

                                            <form action="{{ route('member.destroy', $item->id) }}"
                                                  method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button onclick="return confirm('Hapus data?')"
                                                        class="px-3 py-2 bg-red-500 text-white rounded">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-10 text-center text-gray-500">
                                        Data member kosong
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="p-6 border-t">
                    {{ $member->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>