<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="transition transform hover:scale-105 duration-300">
                        <!-- Jika Anda punya logo gambar, bisa ditaruh di sini. Jika pakai logo default Laravel, kita beri warna aksen -->
                        <x-application-logo class="block h-9 w-auto fill-current text-blue-500" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- 1. Dashboard -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    @if(Auth::user()->role === 'admin')
                    <!-- 2. Inventaris Mobil (Hanya Admin) -->
                    <x-nav-link :href="url('/admin/mobils')" :active="request()->is('admin/mobils*')">
                        {{ __('Inventaris Mobil') }}
                    </x-nav-link>

                    <!-- 3. Kelola Transaksi (Hanya Admin) -->
                    <x-nav-link :href="route('admin.rentals.index')" :active="request()->routeIs('admin.rentals.index')">
                        {{ __('Kelola Transaksi') }}
                    </x-nav-link>
                    @endif
                    
                    @if(Auth::user()->role === 'user')
                    <!-- 4. Riwayat Transaksi (Hanya User) -->
                    <x-nav-link :href="route('rentals.riwayat')" :active="request()->routeIs('rentals.riwayat')">
                        {{ __('Riwayat Transaksi') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <!-- Menambahkan efek hover teks Biru Muda pada tombol profil -->
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-blue-500 focus:outline-none transition ease-in-out duration-150 group">
                        
                        <!-- Memberikan aksen border Biru Muda pada foto profil -->
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-50 border-2 border-blue-100 flex-shrink-0 mr-2 transition-colors group-hover:border-blue-300 shadow-sm">
                            @if(Auth::user()->foto_profil)
                                <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Foto" class="w-full h-full object-cover">
                            @else
                                <svg class="w-full h-full text-gray-300 mt-1" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            @endif
                        </div>
                        
                        <div class="font-semibold">{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 transition-transform duration-200 group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-blue-50 hover:text-blue-600">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    class="hover:bg-red-50 hover:text-red-600"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Tampilan Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <!-- Mengubah efek hover hamburger menu menjadi Biru Muda -->
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-blue-500 hover:bg-blue-50 focus:outline-none focus:bg-blue-50 focus:text-blue-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Tampilan Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
            <x-responsive-nav-link :href="url('/admin/mobils')" :active="request()->is('admin/mobils*')">
                {{ __('Inventaris Mobil') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.rentals.index')" :active="request()->routeIs('admin.rentals.index')">
                {{ __('Kelola Transaksi') }}
            </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role === 'user')
            <x-responsive-nav-link :href="route('rentals.riwayat')" :active="request()->routeIs('rentals.riwayat')">
                {{ __('Riwayat Transaksi') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-100 bg-gray-50">
            <div class="px-4 flex items-center">
                <div class="w-10 h-10 rounded-full overflow-hidden bg-white border-2 border-blue-100 flex-shrink-0 mr-3 shadow-sm">
                    @if(Auth::user()->foto_profil)
                        <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Foto" class="w-full h-full object-cover">
                    @else
                        <svg class="w-full h-full text-gray-300 mt-1" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    @endif
                </div>

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>