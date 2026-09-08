<nav x-data="{ open: false }" class="fixed top-0 w-full z-10 bg-white border-b border-white-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    {{-- LOGO ROUTE - MENGARAHKAN KE DASHBOARD YANG TEPAT --}}
                    <a
                        href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('teacher.dashboard') }}">
                        <x-application-logo class="block h-7 w-auto fill-current text-gray-800"
                            style="width: 40px; height: auto;" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    @if (Auth::user()->isAdmin())
                        {{-- MENU ADMIN UTAMA --}}
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard Admin') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.data-user')" :active="request()->routeIs('admin.data-user')">
                            {{ __('Data User') }}
                        </x-nav-link>
                    @elseif (Auth::user()->isTeacher())
                        {{-- MENU TEACHER / GURU --}}
                        <x-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')">
                            {{ __('Dashboard Guru') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.data-peserta-didik')" :active="request()->routeIs('teacher.data-peserta-didik')">
                            {{ __('Peserta Didik') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.data-ppdb')" :active="request()->routeIs('teacher.data-ppdb')">
                            {{ __('Data PPDB') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.informasi')" :active="request()->routeIs('teacher.informasi')">
                            {{ __('Informasi') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- Dropdown Profile (Sama untuk semua staf) --}}
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-900 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
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
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Tombol Burger (Sama) --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Responsif (Mobile) --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->isAdmin())
                {{-- MENU RESPONSIF ADMIN UTAMA --}}
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.data-user')" :active="request()->routeIs('admin.data-user')">
                    {{ __('Data User') }}
                </x-responsive-nav-link>
            @elseif (Auth::user()->isTeacher())
                {{-- MENU RESPONSIF TEACHER / GURU --}}
                <x-responsive-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')">
                    {{ __('Dashboard Guru') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.data-peserta-didik')" :active="request()->routeIs('teacher.data-peserta-didik')">
                    {{ __('Data Peserta Didik') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.data-ppdb')" :active="request()->routeIs('teacher.data-ppdb')">
                    {{ __('Data PPDB') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.informasi')" :active="request()->routeIs('teacher.informasi')">
                    {{ __('Informasi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.contact')" :active="request()->routeIs('teacher.contact')">
                    {{ __('Contact') }}
                </x-responsive-nav-link>
            @endif
        </div>

        {{-- Profile Responsif (Sama untuk semua staf) --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>