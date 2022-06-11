<x-employee-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel pracownika
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div c class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="flex items-center justify-between mt-8 text-2xl">
                        <p>Zamówienia ({{ count($orders) }})</p>
                        <a href="{{ route('edashboard.orders_today') }}">
                            <x-jet-button>Zamówienia z dnia dzisiejszego</x-jet-button>
                        </a>
                    </div>

                    <div class="mt-6 text-gray-500 mb-6">
                        @if(count($orders) == 0)
                            Brak zamówień w bazie danych.
                        @else
                            Wszystkie złożone zamówienia nie tylko z dnia dzisiejszego.
                        @endif
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Imię i nazwisko
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Numer telefonu
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Płatność
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cena
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Opcje</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $order->id }}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $order->user->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $order->phone_number }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->payment ? 'Karta płatnicza' : 'Gotówka' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->price }} zł
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-orange-400">{{ $order->getStatusName() }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="orders/{{ $order->id }}/edit" class="font-medium text-blue-600 hover:underline">Zarządzaj</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-employee-layout>
