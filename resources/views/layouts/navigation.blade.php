<nav x-data="{ open: false }"
     class="bg-white border-b border-gray-100">

    <!-- DESKTOP -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">


            {{-- LOGO --}}
            <div class="flex items-center">

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



            {{-- MENU DESKTOP --}}
            <div class="hidden sm:flex items-center space-x-6">


                {{-- DASHBOARD --}}
                @if(auth()->user()->role == 'admin')

                    <x-nav-link :href="route('dashboard')">

                        Dashboard

                    </x-nav-link>

                @endif


                @if(auth()->user()->role == 'anggota')

                    <x-nav-link :href="route('anggota.dashboard')">

                        Dashboard

                    </x-nav-link>

                @endif



                {{-- KATALOG --}}
                <x-nav-link :href="route('katalog.index')">

                    Katalog

                </x-nav-link>



                {{-- ADMIN MENU --}}
                @if(auth()->user()->role == 'admin')


                {{-- MASTER --}}
                <div x-data="{dropdown:false}"
                     class="relative">

                    <button @click="dropdown=!dropdown"
                            class="px-3 py-2 text-sm text-gray-700 hover:text-blue-600">

                        Master ▾

                    </button>


                    <div x-show="dropdown"
                         @click.outside="dropdown=false"
                         class="absolute bg-white shadow-lg rounded-lg w-52 mt-2 z-50">


                        <a href="{{ route('kelas.index') }}"
                           class="block px-4 py-3 hover:bg-gray-100">

                            Kelas

                        </a>


                        <a href="{{ route('jurusan.index') }}"
                           class="block px-4 py-3 hover:bg-gray-100">

                            Jurusan

                        </a>


                        <a href="{{ route('kategori.index') }}"
                           class="block px-4 py-3 hover:bg-gray-100">

                            Kategori

                        </a>


                        <a href="{{ route('rak.index') }}"
                           class="block px-4 py-3 hover:bg-gray-100">

                            Rak

                        </a>


                    </div>

                </div>




                {{-- DATA --}}
                <div x-data="{dropdown:false}"
                     class="relative">


                    <button @click="dropdown=!dropdown"
                            class="px-3 py-2 text-sm text-gray-700 hover:text-blue-600">

                        Data ▾

                    </button>


                    <div x-show="dropdown"
                         @click.outside="dropdown=false"
                         class="absolute bg-white shadow-lg rounded-lg w-52 mt-2 z-50">


                        <a href="{{ route('member.index') }}"
                           class="block px-4 py-3 hover:bg-gray-100">

                            Member

                        </a>


                        <a href="{{ route('buku.index') }}"
                           class="block px-4 py-3 hover:bg-gray-100">

                            Buku

                        </a>


                    </div>


                </div>



                {{-- TRANSAKSI --}}
                <div x-data="{dropdown:false}"
                     class="relative">


                    <button @click="dropdown=!dropdown"
                            class="px-3 py-2 text-sm text-gray-700 hover:text-blue-600">

                        Transaksi ▾

                    </button>


                    <div x-show="dropdown"
                         @click.outside="dropdown=false"
                         class="absolute bg-white shadow-lg rounded-lg w-52 mt-2 z-50">


                        <a href="{{ route('pinjam.index') }}"
                           class="block px-4 py-3 hover:bg-gray-100">

                            Peminjaman

                        </a>


                    </div>


                </div>


                @endif



            </div>




            {{-- PROFILE DESKTOP --}}
            <div class="hidden sm:flex items-center">

                <x-dropdown align="right" width="48">


                    <x-slot name="trigger">


                        <button class="flex items-center gap-2 text-gray-700">


                            {{ Auth::user()->name }}


                            <span>
                                ▾
                            </span>


                        </button>


                    </x-slot>



                    <x-slot name="content">


                        <x-dropdown-link :href="route('profile.edit')">

                            Profile

                        </x-dropdown-link>



                        <form method="POST"
                              action="{{ route('logout') }}">


                            @csrf


                            <x-dropdown-link href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>


                        </form>


                    </x-slot>


                </x-dropdown>


            </div>



            {{-- HAMBURGER MOBILE --}}
            <div class="flex items-center sm:hidden">


                <button @click="open=!open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100">


                    <svg class="h-6 w-6"
                         stroke="currentColor"
                         fill="none"
                         viewBox="0 0 24 24">


                        <path x-show="!open"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>


                        <path x-show="open"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>


                    </svg>


                </button>


            </div>



        </div>

    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open"
         class="sm:hidden border-t bg-white">


        <div class="px-4 py-4 space-y-2">


            <a href="{{ route('anggota.dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100">

                Dashboard

            </a>


            <a href="{{ route('katalog.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100">

                Katalog

            </a>



            <form method="POST"
                  action="{{ route('logout') }}">


                @csrf


                <button class="w-full text-left px-3 py-2 hover:bg-gray-100">

                    Logout

                </button>


            </form>


        </div>


    </div>


</nav>