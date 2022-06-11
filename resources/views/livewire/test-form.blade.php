
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if(session()->has('message'))
                    <div class="text-center font-semibold text-md">
                        {{ session('message') }}
                    </div>
                @endif
                @if($step == 1)
                        <div class="flex items-center justify-between mb-2">
                            <p class="flex font-semibold p-6 text-xl">Etap 1: wybór sposobu otrzymania zamówienia</p>
                            <a class="text-gray-600 text-sm hover:underline" wire:click="chooseDelivery()">
                                Wybieram odbiór osobisty w restauracji
                            </a>
                        </div>
                    @if($addresses->count() > 0)
                        @foreach($addresses as $address)
                            <div class="mx-auto lg:w-1/2 sm:w-full border-2 border-gray-300 bg-gray-50 rounded-md mt-2 p-2">
                                <div class="lg:flex items-center lg:justify-between">
                                    <div class="sm:w-full">
                                        <h2 class="font-semibold text-gray-400">{{ $address->name }}</h2>
                                        <p class="text-sm">{{ $address->user->name }}</p>
                                        <p class="text-sm">{{ $address->street }} {{ $address->number }} {{ !empty($address->flat) ? ' / '.$address->flat : '' }}</p>
                                        <p class="text-sm">{{ $address->city . ' ' .  $address->zipcode }}</p>
                                    </div>
                                    <div>
                                    <!-- <x-jet-secondary-button><a href="/order/create/step-one/{{ $address->id }}">Wybierz</a></x-jet-secondary-button> -->
                                        <div class="lg:flex sm:w-full sm:items-center">
                                            <x-jet-button wire:click="selectAddress({{ $address->id }})">Dostawa na ten adres</x-jet-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-3 text-gray-500 text-center">
                            Aby dodać nowy adres naciśnij przycisk na dole w celu przekierowania do formularza dodawania adresu.
                        </div>
                        <div class=" text-center mt-2">
                            <x-jet-button><a href="{{ route('address.create') }}">Nowy adres dostawy</a> </x-jet-button>
                        </div>
                    @else
                        <div class="mt-8 text-center text-2xl text-red-500">
                            Brak istniejących adresów dostaw
                        </div>
                        <div class="mt-6 text-gray-500">
                            Wygląda na to, że to konto użytkownika nie posiada jeszcze zapisanego adresu dostaw. Aby w pełni wykorzystać możliwość złożenia szybkiego zamówienia w przyszłości, sugerujemy zapisanie adresu teraz, aby szybciej składać zamówienia online.
                        </div>
                        <div class=" text-center mt-2">
                            <x-jet-button><a href="{{ route('address.create') }}">Nowy adres dostawy</a> </x-jet-button>
                        </div>
                    @endif
                @elseif($step == 2)
                    <div>
                        <!-- <x-jet-application-logo class="block h-12 w-auto" /> -->
                        <div class="flex items-center justify-between mb-2 border-b-2 border-gray-400">
                            <p class="flex font-semibold p-6 text-xl">Etap 2: sporządzenie zamówienia</p>
                            <a class="text-gray-400 text-sm hover:underline" wire:click="previousStep">
                                Wybrany sposób: {{ $selected_address_fullname ? 'dostawa na adres '. $selected_address_fullname : 'odbiór osobisty w restauracji' }}
                            </a>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="w-1/2">
                                <div class="items-center bg-gray-50 rounded-md">
                                    <div class="p-2  mb-4">
                                        @foreach($items_catalog as $item)
                                            <div class="rounded overflow-hidden shadow-lg">
                                                <div class="px-6 py-4">
                                                    <div class="font-bold text-xl mb-2">{{ $item->category->name }} <span class="font-medium">{{ $item->name }}</span> </div>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 m-2">{{ $item->price }} zł</span>
                                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 m-2">{{ $item->portion }}</span>
                                                    <button wire:click="addItem({{ $item }})" class="flex inset-0 bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 m-2 hover:border-2 border-red-500">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                        Do koszyka
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
{{--                            pseudo podglad koszyka--}}
                            <div class="w-1/4">
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
{{--                        wszystko inne ma być wyżej--}}
                        <div class="flex items-center justify-between">
                            <x-jet-secondary-button wire:click="previousStep">Zmiana adresu</x-jet-secondary-button>
                            <span class="text-center text-lg">Koszt zamówienia: <span class="text-center text-lg text-green-400">{{ $price }}</span> zł</span>
                            <x-jet-button wire:click="nextStep">Płatność</x-jet-button>
                        </div>
                    </div>
                @endif
                @if($step == 3)
                    <div class="container">
                        <p class="flex font-semibold p-6 text-xl">Etap 3: sposób płatności</p>
                        <div class="flex">
                            <div class="w-1/2">
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
                            <div class="w-1/2 items-center border-l-2 border-gray-400">
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
                        <div class="flex items-center justify-between">
                            <x-jet-secondary-button wire:click="previousStep">Powrót</x-jet-secondary-button>
                            <span class="text-center lg:text-lg">Koszt zamówienia: <span class="text-center text-lg text-green-400">{{ $price }}</span> zł</span>
                            <x-jet-button wire:click="nextStep">Złóż zamówienie</x-jet-button>
                        </div>
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @elseif($step == $max_step)
                    <div class="container">
                        <p class="text-center font-semibold p-6 text-xl">Podsumowanie zamówienia</p>
                        <div class="flex">
                            <div class="w-1/2">
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
                            <div class="w-1/2 items-center border-l-2 border-gray-400">
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
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

