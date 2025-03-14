<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'pegawai')
                    <x-nav-link :href="route('share.anggota.index')" :active="request()->routeIs('share.anggota.index')">
                        {{ __('Anggota') }}
                    </x-nav-link>
                    <x-nav-link :href="route('share.simpan.index')" :active="request()->routeIs('share.simpan.index')">
                        {{ __('Simpan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('share.pinjam.index')" :active="request()->routeIs('share.pinjam.index')">
                        {{ __('Pinjam') }}
                    </x-nav-link>
                    <x-nav-link :href="route('share.angsuran.index')" :active="request()->routeIs('share.angsuran.index')">
                        {{ __('Angsuran') }}
                    </x-nav-link>
                    <x-nav-link :href="route('share.laporan.index')" :active="request()->routeIs('share.laporan.index')">
                        {{ __('Laporan') }}
                    </x-nav-link>

                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.master-data.index')" :active="request()->routeIs('admin.master-data.index')">
                            {{ __('Master Data') }}
                        </x-nav-link>
                    @endif
                @elseif(auth()->user()->role === 'anggota')
                    <x-nav-link :href="route('anggota.transaksi')" :active="request()->routeIs('anggota.transaksi')">
                        {{ __('Transaksi Saya') }}
                    </x-nav-link>
                @endif

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
