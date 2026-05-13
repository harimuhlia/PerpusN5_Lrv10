<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Trash Member
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                {{-- HEADER --}}
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Data Member Terhapus
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Daftar member yang telah dihapus sementara
                        </p>
                    </div>

                    <a href="{{ route('member.index') }}"
                       class="px-4 py-2 bg-gray-500 text-white text-sm rounded-lg hover:bg-gray-600 transition">
                        Kembali
                    </a>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">
                                    ID Register
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nama
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">
                                    Email
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">
                                    Kelas
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">
                                    No WA
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">
                                    Aksi
                                </th>
                            </tr>

                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse($member as $item)

                                <tr class="hover:bg-gray-50">

                                    {{-- ID REGISTER --}}
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-blue-600">
                                            {{ $item->id_register }}
                                        </span>
                                    </td>

                                    {{-- NAMA --}}
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-800">
                                            {{ $item->name }}
                                        </div>
                                    </td>

                                    {{-- EMAIL --}}
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $item->email }}
                                    </td>

                                    {{-- KELAS --}}
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $item->kelas->nama_kelas ?? '-' }}
                                    </td>

                                    {{-- NO WA --}}
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $item->no_wa ?? '-' }}
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-4">

                                        <div class="flex justify-center gap-2">

                                            {{-- RESTORE --}}
                                            <a href="{{ route('member.restore', $item->id) }}"
                                               class="px-4 py-2 bg-green-500 text-white text-xs rounded-lg hover:bg-green-600 transition">

                                                Restore

                                            </a>

                                            {{-- FORCE DELETE --}}
                                            <form action="{{ route('member.forceDelete', $item->id) }}"
                                                  method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        onclick="return confirm('Yakin ingin menghapus permanen data ini?')"
                                                        class="px-4 py-2 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600 transition">

                                                    Delete Permanen

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Tidak ada data member di trash

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="p-6 border-t border-gray-200">
                    {{ $member->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>