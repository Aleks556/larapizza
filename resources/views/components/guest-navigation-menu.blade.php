<nav x-data="{ open: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
        <div class="flex">
            <!-- Logo -->
            <x-logo />

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-jet-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                    Strona główna
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('dishes') }}" :active="request()->routeIs('dishes')">
                    Menu
                </x-jet-nav-link>
                <x-jet-nav-link href="#" :active="request()->routeIs('#')"> <!-- request()->routeIs('dashboard') -->
                    Kontakt
                </x-jet-nav-link>
            </div>
        </div>
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            @auth()
                <p class="text-sm">
                    Witaj, {{ auth()->user()->name }}! Aby przejść do panelu klienta
                    <span class="font-semibold">
                        <a class="hover:underline hover:text-green-500" href="{{ route('dashboard') }}">naciśnij tutaj.</a>
                    </span>
                </p>
            @endauth
            @guest()
                <a href="{{ route('login') }}">
                    <x-jet-button class="mr-2">Zaloguj się</x-jet-button>
                </a>
                <a href="{{ route('register') }}">
                    <x-jet-secondary-button>Zarejestruj się</x-jet-secondary-button>
                </a>
            @endguest


        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>


    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                Strona główna
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('dishes') }}" :active="request()->routeIs('dishes')">
                Menu
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('addresses') }}" :active="request()->routeIs('addresses')">
                Kontakt
            </x-jet-responsive-nav-link>
        </div>

        @auth()
            <div class="pt-4 pb-1 border-t border-gray-200">
                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <p class="font-medium text-base text-gray-800">Panel klienta</p>
                    <p class="font-medium text-sm text-gray-500">Naciśnij tutaj, aby przejść do panelu klienta.</p>
                </x-jet-responsive-nav-link>
            </div>
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        Ustawienia konta
                    </x-jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                   @click.prevent="$root.submit();">
                            Wyloguj się
                        </x-jet-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest()
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-jet-responsive-nav-link href="{{ route('login') }}">
                        Zaloguj się
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('register') }}">
                        Zarejestruj się
                    </x-jet-responsive-nav-link>

                </div>
            </div>
        @endguest

    </div>
</nav>
