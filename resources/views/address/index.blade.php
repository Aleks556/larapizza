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
                        <p class=" mb-2 text-2xl font-bold tracking-tight text-gray-900">Zapisane adresy</p>
                    </div>
                    @if(session()->has('message'))
                        <div class="text-center font-semibold text-md">
                            {{ session('message') }}
                        </div>
                    @endif


                    @if($addresses->count() > 0)
                        @foreach($addresses as $address)
                            <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                                <a href="{{ route('address.edit', $address->id) }}">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $address->name }}</h5>
                                </a>
                                <p class=" font-normal text-gray-700">{{ $address->street }} {{ $address->number }} {{ !empty($address->flat) ? ' / '.$address->flat : '' }}</p>
                                <p class="mb-3 font-normal text-gray-700">{{ $address->zipcode }} {{ $address->city }}</p>
                                <a href="{{ route('address.edit', $address->id) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Edytuj
                                    <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <a href="{{ route('address.delete', $address->id) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                    Usuń
                                    <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        @endforeach
                            <div class="mt-3 text-gray-500 text-center">
                                <p class="mb-2">Aby dodać nowy adres naciśnij przycisk na dole w celu przekierowania do formularza dodawania adresu.</p>
                                <a href="{{ route('address.create') }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                    Nowy adres
                                    <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </a>
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
