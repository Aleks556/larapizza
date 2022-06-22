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
                                <p class="mb-2 font-normal tracking-tight text-gray-900"> Aby przejść do tworzenia nowego zamówienia proszę nacisnąć przycisk znajdujący się poniżej.</p>
                                <a href="{{ route('order.create') }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                    Nowe zamówienie
                                    <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </a>
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-2">
                            @foreach($orders as $order)
                                <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mb-2">
                                    <a href="{{ route('order.show', $order->id) }}">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Zamówienie ID {{ $order->id }}</h5>
                                    </a>
                                    <p class=" font-normal text-gray-700">Typ płatności: {{ $order->payment ? 'Karta płatnicza' : 'Gotówka' }}</p>
                                    <p class="mb-3 font-normal text-gray-700">Cena: <span class="text-green-600 font-bold">{{ $order->price }}</span>  zł</p>
                                    <a href="{{ route('order.show', $order->id) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                                        Szczegóły
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('order.report', $order->id) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                        Zgłoś
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        {{ $orders->links() }}
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
