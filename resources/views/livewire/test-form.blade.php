
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if($step == 1)
                        <div class="sm:flex text-center items-center justify-between mb-2">
                            <p class="font-light p-6 text-xl tracking-tight">Etap 1: wybór sposobu otrzymania zamówienia</p>
                            <button  wire:click="chooseDelivery()" type="button" class=" inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                                Odbiór w restauracji
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </button>
                        </div>
                    @if($addresses->count() > 0)
                        @foreach($addresses as $address)
                                <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $address->name }}</h5>
                                    <p class=" font-normal text-gray-700">{{ $address->street }} {{ $address->number }} {{ !empty($address->flat) ? ' / '.$address->flat : '' }}</p>
                                    <p class="mb-3 font-normal text-gray-700">{{ $address->zipcode }} {{ $address->city }}</p>
                                    <button type="button" wire:click="selectAddress({{ $address->id }})" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                                        Dostawa
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </div>
                        @endforeach
                        <div class="mt-3 text-gray-500 text-center">
                            Aby dodać nowy adres naciśnij przycisk na dole w celu przekierowania do formularza dodawania adresu.
                        </div>
                        <div class=" text-center mt-2">
                            <button type="button" href="{{ route('address.create') }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                Nowy adres
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </button>
                        </div>
                    @else
                        <div class="mt-8 text-center text-2xl text-red-500">
                            Brak istniejących adresów dostaw
                        </div>
                        <div class="mt-6 text-gray-500">
                            Wygląda na to, że to konto użytkownika nie posiada jeszcze zapisanego adresu dostaw. Aby w pełni wykorzystać możliwość złożenia szybkiego zamówienia w przyszłości, sugerujemy zapisanie adresu teraz, aby szybciej składać zamówienia online.
                        </div>
                        <div class=" text-center mt-2">
                            <a href="{{ route('address.create') }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                Nowy adres
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </a>
                        </div>
                    @endif
                @elseif($step == 2)
                    <div>
                        <!-- <x-jet-application-logo class="block h-12 w-auto" /> -->
                        <div class="sm:flex items-center justify-between mb-2">
                            <p class="font-normal p-6 sm:text-xl">Etap 2: sporządzenie zamówienia</p>
                            <a class="lg:text-center text-gray-400 hover:underline text-sm" wire:click="previousStep">
                                Naciśnij, aby zmienić: {{ $selected_address_fullname ? 'dostawa na adres '. $selected_address_fullname : 'odbiór osobisty w restauracji' }}
                            </a>
                        </div>
                        <div class="sm:flex items-center justify-between">
                            <div class="sm:w-1/2">
                                <div class="items-center">
                                    <div class="p-2  mb-4">
                                        @foreach($items_catalog as $item)
                                            <div class="p-6 my-2 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item->category->name }} <span class="font-medium">{{ $item->name }}</h5>
                                                <div class="flex items-center justify-between">
                                                    <p class=" font-normal text-gray-800">{{ $item->portion }} za <span class="text-green-500">{{ $item->price }} zł</span></p>
                                                    <button type="button" wire:click="addItem({{ $item }})" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                                                        Do koszyka
                                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
{{--                            pseudo podglad koszyka--}}
                            <div class="sm:w-1/2">
                                @if(count($items_cart) > 0)
                                    <div class="text-center text-lg">Wybrane produkty ({{ count($items_cart) }})</div>
                                    <ul>

                                        @foreach($items_cart as $item)

                                            <div class="flex inset-0 font-semibold text-sm">
                                                <svg wire:click="deleteItem({{ json_encode($item) }})" class="w-4 h-4 fill-current text-gray-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    <span>{{ $item[4] }} <span class="font-medium text-sm"> {{ $item[1] }}</span></span>
                                            </div>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-center text-gray-400 text-md">Brak produktów dodanych do zamówienia.</p>
                                @endif
                            </div>
                        </div>
                        @if(session()->has('message'))
                            <div class="my-4 text-center font-semibold text-md">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="sm:flex text-center sm:items-center sm:justify-between">
                            <button type="button"  wire:click="previousStep" class="hidden lg:inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                                <svg class="mr-2 -ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Zmiana adresu
                            </button>
                            <p class="text-center text-lg">Koszt zamówienia: <span class="text-center text-lg text-green-400">{{ $price }}</span> zł</p>

                            <button type="button"  wire:click="nextStep()" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                                Przejdź do płatności
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </button>
                        </div>
                    </div>
                @endif
                @if($step == 3)
                    <p class="font-normal p-6 text-xl tracking-tight">Etap 3: sposób płatności</p>
                    <div class="sm:flex">
                        <div class="sm:w-1/2">
                            <x-jet-dropdown align="none" dropdownClasses="relative lg:w-60" contentClasses="lg:w-60"  class="mb-5">
                                <x-slot name="trigger">
                                    <x-dropdown-trigger>
                                        @if($payment_type === 0)
                                            Gotówka
                                        @elseif($payment_type === 1)
                                            Karta płatnicza
                                        @else
                                            Sposób płatności
                                        @endif
                                    </x-dropdown-trigger>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-green-400">
                                        Dostępne płatności:
                                    </div>
                                    <x-jet-dropdown-link wire:click="setPaymentType(0)">Gotówka</x-jet-dropdown-link>
                                    <x-jet-dropdown-link wire:click="setPaymentType(1)">Karta płatnicza</x-jet-dropdown-link>
                                </x-slot>
                            </x-jet-dropdown>
                            <div class="my-2">
                                <form>
                                    @csrf

                                    <x-jet-label class="mb-2">Numer telefonu:</x-jet-label>
                                    <x-jet-input name="phone_number" wire:model="phone_number" placeholder="(obowiązkowo)" class="text-sm lg:w-72 border-2 border-gray-200 rounded-md hover:border-gray-500"></x-jet-input>
                                    @error('phone_number')
                                        <p class="text-sm text-red-500">Wprowadzono nieprawidłowy numer telefonu.</p>
                                    @enderror
                                    <x-jet-label class="mb-2">Komentarz:</x-jet-label>
                                    <textarea class="text-sm lg:w-72 border-2 border-gray-200 rounded-md hover:border-gray-500" wire:model="comment" name="comment" placeholder="(opcjonalnie)"></textarea>
                                </form>
                            </div>
                        </div>
                        <div class="sm:w-1/2 items-center sm:border-l-2 border-gray-400 my-4">
                            <p class="text-center text-md text-gray-400 font-semibold">Wcześniej wybrane produkty:</p>
                            @foreach($items_cart as $item)
                                <p class="text-center text-sm text-gray-600 font-medium">
                                    <span class="font-semibold ">
                                        {{ $item[4] }}
                                    </span>
                                    {{ $item[1] }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                    @if(session()->has('message'))
                        <div class="my-4 text-center font-semibold text-md">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <button type="button"  wire:click="previousStep" class="hidden lg:inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                            <svg class="mr-2 -ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Powrót
                        </button>
                        <span class="text-center lg:text-lg">Koszt zamówienia: <span class="text-center text-lg text-green-400">{{ $price }}</span> zł</span>
                        <button type="button"  wire:click="nextStep()" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                            Złóż zamówienie
                            <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </button>
                    </div>
                @elseif($step == $max_step)
                    <p class="text-center font-semibold p-6 text-xl">Podsumowanie zamówienia</p>
                    <div class="sm:flex">
                        <div class="sm:w-1/2">
                            <p class="text-center text-md text-gray-400 font-semibold">Dane zamówienia</p>
                            @if($delivery === 1)
                                <div class="text-sm">
                                    <p>{{ auth()->user()->name }}</p>
                                    <p>{{ $selected_address_fullname }}</p>
                                    <p>{{ $selected_address->zipcode }} {{ $selected_address->city }}</p>
                                    <p>Typ płatności: {{ $payment_type ? 'Karta płatnicza' : 'Gotówka' }}</p>
                                    <p>Numer telefonu: <span class="font-semibold">{{ $phone_number }}</span></p>
                                    <p>Komentarz: {{ $comment }}</p>
                                </div>
                            @else
                                <div class="text-sm">
                                    <p>{{ auth()->user()->name }}</p>
                                    <p class="font-semibold">Odbiór osobisty w restauracji</p>
                                    <p>Typ płatności: {{ $payment_type ? 'Karta płatnicza' : 'Gotówka' }}</p>
                                    <p>Numer telefonu: <span class="font-semibold">{{ $phone_number }}</span></p>
                                    <p>Komentarz: {{ $comment }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="sm:w-1/2 items-center sm:border-l-2 border-gray-400">
                            <p class="text-center text-md text-gray-400 font-semibold">Zamówione produkty</p>
                            @foreach($items_cart as $item)
                                <p class="text-center text-sm text-gray-600 font-medium">
                                <span class="font-semibold ">
                                    {{ $item[4] }}
                                </span>
                                    {{ $item[1] }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                    <div class="items-center mt-6">
                        <p class="text-center lg:text-lg">Koszt zamówienia: <span class="text-center text-lg text-green-400">{{ $price }}</span> zł</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

