<nav x-data="{ open: false }"
     class="bg-white border-b border-gray-100">

    <!-- PRIMARY MENU -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <div class="flex">

                <!-- LOGO -->
                <div class="shrink-0 flex items-center">

                    @if(auth()->user()->role == 'admin')

                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>

                    @endif

                    @if(auth()->user()->role == 'anggota')

                        <a href="{{ route('anggota.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>

                    @endif

                </div>

                <!-- MENU -->
                <div class="hidden sm:flex sm:items-center sm:ms-10 space-x-6">

                    {{-- DASHBOARD --}}
                    @if(auth()->user()->role == 'admin')

                        <x-nav-link :href="route('dashboard')"
                                    :active="request()->routeIs('dashboard')">

                            Dashboard

                        </x-nav-link>

                    @endif

                    @if(auth()->user()->role == 'anggota')

                        <x-nav-link :href="route('anggota.dashboard')"
                                    :active="request()->routeIs('anggota.dashboard')">

                            Dashboard

                        </x-nav-link>

                    @endif

                    {{-- MASTER --}}
                    @if(auth()->user()->role == 'admin')

                    <div x-data="{ dropdown: false }"
                         class="relative">

                        <button @mouseenter="dropdown = true"
                                @click="dropdown = !dropdown"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">

                            Master

                            <svg class="ms-1 h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>

                            </svg>

                        </button>

                        <div x-show="dropdown"
                             @mouseenter="dropdown = true"
                             @mouseleave="dropdown = false"
                             x-transition
                             class="absolute left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50">

                            <a href="{{ route('kelas.index') }}"
                               class="block px-4 py-3 text-sm hover:bg-gray-100
                               {{ request()->routeIs('kelas.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                                Kelas
                            </a>

                            <a href="{{ route('jurusan.index') }}"
                               class="block px-4 py-3 text-sm hover:bg-gray-100
                               {{ request()->routeIs('jurusan.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                                Jurusan
                            </a>

                            <a href="{{ route('kategori.index') }}"
                               class="block px-4 py-3 text-sm hover:bg-gray-100
                               {{ request()->routeIs('kategori.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                                Kategori
                            </a>

                            <a href="{{ route('rak.index') }}"
                               class="block px-4 py-3 text-sm hover:bg-gray-100
                               {{ request()->routeIs('rak.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                                Rak
                            </a>

                        </div>

                    </div>

                    @endif

                    {{-- DATA --}}
                    @if(auth()->user()->role == 'admin')

                    <div x-data="{ dropdown: false }"
                         class="relative">

                        <button @mouseenter="dropdown = true"
                                @click="dropdown = !dropdown"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">

                            Data

                            <svg class="ms-1 h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>

                            </svg>

                        </button>

                        <div x-show="dropdown"
                             @mouseenter="dropdown = true"
                             @mouseleave="dropdown = false"
                             x-transition
                             class="absolute left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50">

                            <a href="{{ route('member.index') }}"
                               class="block px-4 py-3 text-sm hover:bg-gray-100
                               {{ request()->routeIs('member.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                                Member
                            </a>

                            <a href="{{ route('buku.index') }}"
                               class="block px-4 py-3 text-sm hover:bg-gray-100
                               {{ request()->routeIs('buku.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                                Buku
                            </a>

                        </div>

                    </div>

                    @endif

                    {{-- TRANSAKSI --}}
                    @if(auth()->user()->role == 'admin')

                    <div x-data="{ dropdown: false }"
                         class="relative">

                        <button @mouseenter="dropdown = true"
                                @click="dropdown = !dropdown"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">

                            Transaksi

                            <svg class="ms-1 h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>

                            </svg>

                        </button>

                        <div x-show="dropdown"
                             @mouseenter="dropdown = true"
                             @mouseleave="dropdown = false"
                             x-transition
                             class="absolute left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50">

                            <a href="{{ route('pinjam.index') }}"
                               class="block px-4 py-3 text-sm hover:bg-gray-100
                               {{ request()->routeIs('pinjam.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                                Peminjaman
                            </a>

                        </div>

                    </div>

                    @endif

                    {{-- LAPORAN --}}
                    @if(auth()->user()->role == 'admin')

                    <div x-data="{ dropdown: false }"
                         class="relative">

                        <button @mouseenter="dropdown = true"
                                @click="dropdown = !dropdown"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">

                            Laporan

                            <svg class="ms-1 h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>

                            </svg>

                        </button>

                        <div x-show="dropdown"
                             @mouseenter="dropdown = true"
                             @mouseleave="dropdown = false"
                             x-transition
                             class="absolute left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50">

                            <a href="{{ route('laporan.peminjaman') }}"
                               class="block px-4 py-3 text-sm hover:bg-gray-100
                               {{ request()->routeIs('laporan.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                                Laporan Peminjaman
                            </a>

                        </div>

                    </div>

                    @endif

                    {{-- KATALOG --}}
                    <x-nav-link :href="route('katalog.index')"
                                :active="request()->routeIs('katalog.*')">

                        Katalog

                    </x-nav-link>

                </div>

            </div>

            <!-- SETTINGS -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-blue-600 transition">

                            <div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-1">

                                <svg class="fill-current h-4 w-4"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />

                                </svg>

                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

        </div>

    </div>

</nav>

