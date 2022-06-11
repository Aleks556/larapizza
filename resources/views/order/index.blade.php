<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Zamówienia
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">



                    @if($orders->count() > 0)
                        <div class=" text-center mt-2">
                            <div class="mb-2">
                                <p class="text-gray-400 font-semibold mb-2"> Aby przejść do tworzenia nowego zamówienia proszę nacisnąć przycisk znajdujący się poniżej.</p>
                                <x-jet-button><a href="{{ route('order.create') }}">Nowe zamówienie</a> </x-jet-button>
                            </div>
                        </div>
                        <div class="border-2 border-gray-200 p-3 rounded-md">
                            @foreach($orders as $order)
                                <div class="flex items-center justify-between border-2 border-gray-300 bg-gray-50 rounded-md mt-2 p-2 mx-2 mb-2">
                                    <div>
                                        <h2 class="font-semibold text-gray-400">Numer zamówienia: {{ $order->id }}</h2>
                                        <p class="text-sm">{{ $order->user->name }}</p>
                                        <p class="text-sm">Typ płatności: {{ $order->payment ? 'Karta płatnicza' : 'Gotówka' }}</p>
                                        <p class="text-sm">Cena: <span class="text-green-400 font-sans">{{ $order->price }}</span>  zł</p>
                                    </div>
                                    <div class="flex">
                                        <a href="orders/{{ $order->id }}/report" class="mr-2"><x-jet-danger-button>Zgłoś</x-jet-danger-button></a>
                                        <a href="orders/{{ $order->id }}"><x-jet-secondary-button>Pokaż szczegóły</x-jet-secondary-button></a>

                                    </div>
                                </div>
                            @endforeach
                        </div>
{{--                        <div class="mt-3 text-gray-500 text-center">--}}
{{--                            Aby dodać nowy adres naciśnij przycisk na dole w celu przekierowania do formularza dodawania adresu.--}}
{{--                        </div>--}}
{{--                        <div class=" text-center mt-2">--}}
{{--                            <x-jet-button><a href="{{ route('address.create') }}">Nowy adres dostawy</a> </x-jet-button>--}}
{{--                        </div>--}}
                    @else
                        <div class="mt-8 text-center text-2xl text-red-500">
                            Brak zamówień składanych z tego konta.
                        </div>
                        <div class="mt-6 text-gray-500 text-center">
                            Wygląda na to, że z tego konta użytkownika jeszcze nie było żadnych składanych zamówień.
                        </div>
                        <div class=" text-center mt-2">
                            <x-jet-button><a href="{{ route('order.create') }}">Nowe zamówienie</a> </x-jet-button>
                        </div>
                    @endif




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
