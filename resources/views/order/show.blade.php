<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Szczegóły zamówienia
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="sm:flex justify-between text-center mb-2">
                        <a href="{{ route('orders') }}" class="text-sm inline-flex hover:underline group inset-0">
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
                    <div class="sm:flex">
                        <div class="sm:w-1/2">
                            @if($order->delivery == 1)
                                <p class="text-center text-lg font-semibold mb-4">Dane dostawy</p>
                                <ul class="text-center mb-4">
                                    <li><p class="text-gray-600"></p>Ul. {{ $order->street }} {{ $order->number }} {{ $order->flat ? '/ '.$order->flat : ''  }}</li>
                                    <li><p class="text-gray-600"></p>{{ $order->zipcode }} {{ $order->city }} </li>
                                    <li><p class="text-gray-600"></p>Komentarz: {{ $order->comment }} </li>
                                </ul>
                            @else
                                <p class="text-center text-lg font-semibold mb-4">Dane dostawy</p>
                                <p class="text-center font-semibold">Odbiór osobisty w restauracji przez {{ $order->user->name }}</p>
                                <p class="text-center text-gray-600">Komentarz: {{ $order->comment }}</p>
                            @endif
                                <p class="text-center text-lg font-semibold mb-4">Sposób płatności</p>
                                <ul class="text-center mb-4">
                                    <li><p class="text-gray-600"></p>Wybrany sposób: {{ $order->payment ? 'Karta płatnicza' : 'Gotówka' }}</li>
                                </ul>

                        </div>
                        <div class="sm:w-1/2 sm:border-l-2">
                            <p class="text-center text-lg font-semibold mb-4">Zamówione produkty</p>
                            <ul class="text-center mb-4">
                                @foreach($order_items as $order_item)
                                    <li><p class="text-gray-600">{{ $order_item->item->category->name }} {{ $order_item->item->name }} <span class="text-sm text-gray-400">{{ $order_item->item->price }} zł</span></p></li>
                                @endforeach
                            </ul>
                            <p class="text-center font-semibold text-lg">Suma: <span class="text-green-500"> {{ $order->price }}</span> zł</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
