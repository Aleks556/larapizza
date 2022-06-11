<x-employee-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ $employee->user->name }} - szczegóły pracownika
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
{{--                TODO po ogarnieciu zapisywania sie na zmiane kontynuowac kodowanie etutaj--}}
                <p class="text-lg font-semibold">Dane pracownika</p>
                <p class="font-semibold">Imię i Nazwisko</p>
                <p>{{ $employee->user->name }}</p>
                <p class="font-semibold">Stanowisko</p>
                <p>{{ $employee->role->name }}</p>
                <p class="font-semibold">Student</p>
                <p>{{ $employee->student ? 'Tak' : 'Nie' }}</p>
                <p class="font-semibold">Imię i Nazwisko</p>
                <p>{{ $employee->user->name }}</p>
                <p class="font-semibold">Data zatrudnienia</p>
                <p>{{ $employee->created_at }}</p>
                <p class="font-semibold">Numer telefonu</p>
                <p>{{ $employee->phone_number }}</p>
                <p class="text-lg font-semibold">Miejsce zamieszkania</p>
                <p> {{ $employee->address_street }} {{ $employee->address_number }} {{ $employee->address_flat ? ' / ' . $employee->address_flat : '' }}</p>
                <p>{{ $employee->address_zipcode }} {{ $employee->address_city }}</p>
                <p class="text-lg font-semibold">Ostatnia zmiana</p>
                <p class="">Od {{ $shift->created_at }} do {{ $shift->ended_at ? $shift->ended_at : 'Nie zdefiniowano' }}</p>
                @if(isset($shift->ended_at))
                    @if($shift->ended_by !== 0)
                        <p class="text-green-500">Zmiana zakończona przez {{ auth()->user()->getName($shift->ended_by) }}.</p>
                    @else
                        <p class="text-red-500">Zmiana zakończona automatycznie przez system.</p>
                    @endif

                @endif
                {{--                <livewire:edashboard.index.main />--}}
            </div>
        </div>
    </div>
</x-employee-layout>
