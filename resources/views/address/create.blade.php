<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adresy dostaw
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <div class="shrink-0 flex items-center">
                            <a class="flex items-center" href="{{ route('dashboard') }}">
                                <img class="h-10 w-10 mr-2" src="../images/pizzalogo.png"/>
                                <span class="font-semibold text-xl tracking-tight text-gray-800">LaraPizza</span>
                            </a>
                        </div>
                    </div>
                    <div class="mx-auto text-center text-xl text-gray-400  font-semibold">
                        <span class="border-b-2 border-green-400">Nowy adres</span>
                    </div>
                    <form method="POST" action="{{ route('address.store') }}" class="p-6 text-center rounded-xl mt-4">
                        @csrf
                        <label class="block mb-2 uppercase font-bold text-sm text-gray-700 mt-2" for="name">Nazwa adresu</label>
                        <input name="name" type="text" value="{{ old('name') }}" class="border border-gray-200 p-2 rounded w-72 placeholder:text-xs" placeholder="Np. Dom" required/>
                        @error('name')
                            {{ $message }}
                        @enderror

                        <label class="block mb-2 uppercase font-bold text-sm text-gray-700 mt-2" for="street">Nazwa ulicy</label>
                        <input name="street" type="text" value="{{ old('street') }}" class="border border-gray-200 p-2 rounded w-72 placeholder:text-xs" placeholder="Np. ul. Józefa Poniatowskiego" required/>
                        @error('street')
                            {{ $message }}
                        @enderror


                        <label class="block mb-2 uppercase font-bold text-sm text-gray-700 mt-2" for="number">Numer ulicy</label>
                        <input name="number" type="text" value="{{ old('number') }}" class="border border-gray-200 p-2 rounded w-72 placeholder:text-xs" placeholder="Numer ulicy" required/>
                        @error('number')
                            {{ $message }}
                        @enderror

                        <label class="block mb-2 uppercase font-bold text-sm text-gray-700 mt-2" for="flat">Numer lokalu</label>
                        <input name="flat" type="text" value="{{ old('flat') }}" class="border border-gray-200 p-2 rounded w-72 placeholder:text-xs" placeholder="Numer lokalu (opcjonalnie)" required/>
                        @error('flat')
                        {{ $message }}
                        @enderror

                        <label class="block mb-2 uppercase font-bold text-sm text-gray-700 mt-2" for="city">Miasto / miejscowość</label>
                        <input name="city" type="text" value="{{ old('city') }}" class="border border-gray-200 p-2 rounded w-72 placeholder:text-xs" placeholder="Miasto / miejscowość" required/>
                        @error('city')
                        {{ $message }}
                        @enderror

                        <label class="block mb-2 uppercase font-bold text-sm text-gray-700 mt-2" for="zipcode">Kod pocztowy</label>
                        <input name="zipcode" type="text" value="{{ old('zipcode') }}" class="border border-gray-200 p-2 rounded w-72 placeholder:text-xs" placeholder="Np. 37-450" required/>
                        @error('zipcode')
                             <p class="text-red-500">Nieprawidłowy kod pocztowy</p>
                        @enderror

                        <p class="text-center text-gray-500 m-2 text-sm">Przed zapisaniem danych proszę się upewnić, czy są one <span class="underline">prawidłowe</span>.</p>

                        <x-jet-button type="submit">Zapisz adres</x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
