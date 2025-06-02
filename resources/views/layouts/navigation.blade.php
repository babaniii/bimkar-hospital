<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Kiri: Logo + Navigasi -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if (Auth::user()->role == 'dokter')
                        <a href="{{ route('dokter.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    @elseif (Auth::user()->role == 'pasien')
                        <a href="{{ route('pasien.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    @endif
                </div>

                <!-- Navigasi -->
                <div class="hidden sm:flex space-x-6">
                    @if (Auth::user()->role == 'dokter')
                        <x-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dokter.jadwal-periksa.index')" :active="request()->routeIs('dokter.jadwal-periksa.index')">
                            {{ __('Jadwal Periksa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dokter.obat.index')" :active="request()->routeIs('dokter.obat.index')">
                            {{ __('Obat') }}
                        </x-nav-link>
                    @elseif(Auth::user()->role == 'pasien')
                        <x-nav-link :href="route('pasien.dashboard')" :active="request()->routeIs('pasien.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Kanan: Logout -->
            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-black px-4 py-2 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
