<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <!-- NAVBAR -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- KIRI -->
            <div class="flex">

                <!-- LOGO -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- MENU -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        🏠 Dashboard
                    </x-nav-link>

                    <x-nav-link href="/kelas" :active="request()->is('kelas')">
                        📚 Kelas
                    </x-nav-link>

                    <x-nav-link href="/riwayat" :active="request()->is('riwayat')">
                        📄 Riwayat
                    </x-nav-link>

                    <x-nav-link href="/pengajar" :active="request()->is('pengajar')">
                        👨‍🏫 Pengajar
                    </x-nav-link>

                </div>
            </div>

            <!-- KANAN (USER) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white rounded-md hover:text-gray-700">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                ▼
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            👤 Profile
                        </x-dropdown-link>

                        <!-- LOGOUT -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                🚪 Logout
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            <!-- HAMBURGER (HP) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 text-gray-400 hover:text-gray-500">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- MENU HP -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')">
                🏠 Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/kelas">
                📚 Kelas
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/riwayat">
                📄 Riwayat
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/pengajar">
                👨‍🏫 Pengajar
            </x-responsive-nav-link>

        </div>

        <!-- USER HP -->
        <div class="pt-4 pb-1 border-t">

            <div class="px-4">
                <div class="text-base font-medium text-gray-800">
                    {{ Auth::user()->name }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    👤 Profile
                </x-responsive-nav-link>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        🚪 Logout
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>

</nav>