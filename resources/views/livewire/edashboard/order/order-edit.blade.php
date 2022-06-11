<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="flex justify-between text-center mb-2">
                    <a href="{{ route('edashboard.orders_today') }}" class="text-sm inline-flex hover:underline group inset-0">
                        <svg class="w-4 group-hover fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                        Powrót
                    </a>
                    <div class="text-sm font-sans text-gray-300">
                        Data złożenia: {{ $order->created_at }}
                    </div>
                    <div class="text-sm font-sans text-gray-300">
                        Zamówienie nr: {{ $order->id }}
                    </div>
                </div>
                <p class="text-center text-sm">Pamiętaj, aby zaktualizować status zamówienia gdy określone czynności dot. zamówienia zostaną wykonane.</p>

                <div class="lg:flex items-center">
                    <div>
                        <x-jet-label>Status zamówienia:</x-jet-label>
                        <x-jet-dropdown align="none" dropdownClasses="relative lg:w-60" contentClasses="lg:w-60"  class="mb-5">
                            <x-slot name="trigger">
                                <x-dropdown-trigger>
                                    @if($order_status === 0)
                                        Anulowane
                                    @elseif($order_status === 1)
                                        Przyjęte
                                    @elseif($order_status === 2)
                                        Realizacja
                                    @elseif($order_status === 3)
                                        Zakończone
                                    @endif
                                </x-dropdown-trigger>

                            </x-slot>
                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Dostępne statusy:
                                </div>
                                <x-jet-dropdown-link wire:click="setOrderStatus(0)">Anulowane</x-jet-dropdown-link>
                                <x-jet-dropdown-link wire:click="setOrderStatus(1)">Przyjęte</x-jet-dropdown-link>
                                <x-jet-dropdown-link wire:click="setOrderStatus(2)">Realizacja</x-jet-dropdown-link>
                                <x-jet-dropdown-link wire:click="setOrderStatus(3)">Zakończone</x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-label>Sposób wydania:</x-jet-label>
                        <x-jet-dropdown align="none" dropdownClasses="relative lg:w-60" contentClasses="lg:w-60"  class="mb-5">
                            <x-slot name="trigger">
                                <x-dropdown-trigger>
                                    @if($order_delivery === 0)
                                        Odbiór osobisty
                                    @elseif($order_delivery === 1)
                                        Dostawa
                                    @else
                                        Nieznany
                                    @endif
                                </x-dropdown-trigger>

                            </x-slot>

                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Dostępne opcje:
                                </div>
                                <x-jet-dropdown-link wire:click="setDeliveryType(0)">Odbiór osobisty</x-jet-dropdown-link>
                                <x-jet-dropdown-link wire:click="setDeliveryType(1)">Dostawa</x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-label>Sposób płatności:</x-jet-label>
                        <x-jet-dropdown align="none" dropdownClasses="relative lg:w-60" contentClasses="lg:w-60"  class=" mb-5">
                            <x-slot name="trigger">
                                <x-dropdown-trigger>
                                    @if($order_payment === 0)
                                        Gotówka
                                    @elseif($order_payment === 1)
                                        Karta płatnicza
                                    @else
                                        Nieznany
                                    @endif
                                </x-dropdown-trigger>
                            </x-slot>
                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Dostępne opcje:
                                </div>
                                <x-jet-dropdown-link wire:click="setPaymentType(0)">Gotówka</x-jet-dropdown-link>
                                <x-jet-dropdown-link wire:click="setPaymentType(1)">Karta płatnicza</x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>



                        <div class="mx-auto">
                            @if($order_delivery === 1)
                                <div class="mb-6 mt-2">
                                    <label for="street" class="block mb-2 text-sm font-medium text-gray-900">Ulica</label>
                                    <input wire:model="address_street" type="text" id="street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nazwa ulicy" >
                                    @error('address_street')
                                        <p class="block mb-2 text-sm font-medium text-red-500">Przy wybranej opcji dostawy musi być podana nazwa ulicy</p>
                                    @enderror
                                </div>
                                <div class="flex">
                                    <div class="mb-6 mr-2">
                                        <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Numer budynku</label>
                                        <input wire:model="address_number" type="text" id="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Numer budynku">
                                    </div>

                                    <div class="mb-6">
                                        <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Numer lokalu</label>
                                        <input wire:model="address_flat" type="text" id="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Numer lokalu">
                                    </div>
                                </div>
                                @error('address_number')
                                    <p class="block mb-2 text-sm font-medium text-red-500">Przy wybranej opcji dostawy musi być podany numer budynku</p>
                                @enderror
                                <div class="flex">
                                    <div class="mb-6 mr-2">
                                        <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Kod pocztowy</label>
                                        <input wire:model="address_zipcode" type="text" id="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Kod pocztowy">
                                    </div>
                                    <div class="mb-6">
                                        <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Miasto</label>
                                        <input wire:model="address_city" type="text" id="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Miasto">
                                    </div>
                                </div>
                                @error('address_zipcode')
                                    <p class="block mb-2 text-sm font-medium text-red-500">Przy wybranej opcji dostawy musi być podany kod pocztowy</p>
                                @enderror
                                @error('address_city')
                                    <p class="block mb-2 text-sm font-medium text-red-500">Przy wybranej opcji dostawy musi być podana nazwa miejscowości</p>
                                @enderror
                            @endif
                            <div class="mb-6">
                                <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900">Numer telefonu</label>
                                <input wire:model="phone_number" type="text" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Numer telefonu">
                            </div>
                            @error('phone_number')
                                <p class="block mb-2 text-sm font-medium text-red-500">Numer telefonu klienta jest obowiązkowy</p>
                            @enderror
                            <div class="mb-6">
                                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900">Komentarz</label>
                                <textarea wire:model="comment" type="text" id="comment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Komentarz"></textarea>
                            </div>
                        </div>

                </div>


                <p class="text-center text-2xl mb-2">Produkty</p>
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
                                            <button wire:click="addItemFromCatalog({{ $item->id }})" class="flex inset-0 bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 m-2 hover:border-2 border-red-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                Do koszyka
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <p class="text-center text-lg font-semibold mb-4">Produkty dodane do zamówienia</p>
                        <div class="text-center">
                            @foreach($pushed_order_items as $order_item)
{{--                                <svg wire:click="deleteItem({{ json_encode($item) }})" class="w-4 h-4 fill-current text-gray-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>--}}
{{--                                <span class="text-gray-600">{{ $order_item['category'] }} {{ $order_item['name'] }} <span class="text-sm text-gray-400">{{ $order_item['price'] }} zł</span></span>--}}

                                <div class="flex items-center inset-0 text-center font-semibold text-sm">
                                    <svg wire:click="deleteItemFromOrder({{ json_encode($order_item['slot']) }})" class="w-4 h-4 fill-current text-gray-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    <span>{{ $order_item['category'] }} <span class="font-medium text-sm"> {{ $order_item['name'] }}</span></span>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-center font-semibold text-lg mb-6">Suma: <span class="text-green-500"> {{ $price }}</span> zł</p>
                        <div class="text-center">
                            <x-jet-button wire:click="saveOrderChanges()">Zapisz edycję zamówienia</x-jet-button>
                            @if(session()->has('message'))
                                <div class="text-center font-semibold text-md mt-2">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
