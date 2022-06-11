<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Składanie zamówienia
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <!-- <x-jet-application-logo class="block h-12 w-auto" /> -->
                        <p class="font-semibold text-center p-6 text-xl">Etap 1: wybór adresu dostawy</p>
                    </div>

                    @if($addresses->count() > 0)
                        @foreach($addresses as $address)
                            <div class="mx-auto w-1/2 border-2 border-gray-300 bg-gray-50 rounded-md mt-2 p-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="font-semibold text-gray-400">{{ $address->name }}</h2>
                                        <p class="text-sm">{{ $address->user->name }}</p>
                                        <p class="text-sm">{{ $address->street }} {{ $address->number }} {{ !empty($address->flat) ? ' / '.$address->flat : '' }}</p>
                                        <p class="text-sm">{{ $address->city . ' ' .  $address->zipcode }}</p>
                                    </div>
                                    <div>
                                    <!-- <x-jet-secondary-button><a href="/order/create/step-one/{{ $address->id }}">Wybierz</a></x-jet-secondary-button> -->
                                        <div class="flex">
                                            <x-jet-button wire:click="selectAddress({{ $address->id }})">Wybierz</x-jet-button>
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
                            <div class="mt-3 text-gray-500 text-center">
                                Wybrano adres: {{ $selected_address }}
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



