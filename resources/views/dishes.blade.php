<x-guest-layout>
    <nav class="flex items-center justify-between flex-wrap bg-red-600 p-6">
        <div class="flex items-center flex-shrink-0 mr-6">
            <img class="h-14 w-14 mr-2" src="images/pizzalogo.png"/>
            <span class="font-semibold text-xl tracking-tight">LaraPizza</span>
        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <a href="/" class="block mt-4 lg:inline-block lg:mt-0 text-red-200 hover:text-white mr-4 ">
                    Strona główna
                </a>
                <a href="{{ route('dishes') }}" class="{{ request()->routeIs('dishes') ? 'block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4' : 'block mt-4 lg:inline-block lg:mt-0 text-red-200 hover:text-white mr-4'}}">
                    Menu
                </a>
                <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-red-200 hover:text-white">
                    Kontakt
                </a>
            </div>
            <div class="text-sm text-red-200">
                @auth()
                    <a class="hover:text-white" href="{{ route('dashboard') }}">Przejdź do panelu klienta</a>
                @else
                    <a class="hover:text-white" href="{{ route('login') }}">Zaloguj się</a>
                    <a class="ml-4 hover:text-white" href="{{ route('register') }}">Zarejestruj się</a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="bg-black items-center text-center p-6">
        <p class="font-semibold text-2xl text-white">Menu</p>
    </div>

    <div class="p-6 bg-black">
        <div class="container lg:w-1/2 mx-auto relative overflow-x-auto border border-gray-400 shadow-md sm:rounded-lg ">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Produkt
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Porcja
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kategoria
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cena
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($dishes as $dish)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $dish->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $dish->portion }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $dish->category->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $dish->price }} zł
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-guest-layout>
