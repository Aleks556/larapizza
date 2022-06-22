<x-employee-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Zarządzanie zmianami
            </h2>
            <div class="flex">
                <a class="mr-2" href="{{ route('edashboard.employees') }}">
                    <x-jet-secondary-button>Zarządzanie pracownikami</x-jet-secondary-button>
                </a>
                <a href="{{ route('edashboard.roles') }}">
                    <x-jet-secondary-button>Zarządzanie stanowiskami</x-jet-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-xl">Lista pracowników aktualnie pracujących ({{ count($shifts) }})</p>
                            <div class="mt-4">
                                @if(count($shifts) == 0)
                                    <p>Aktualnie nikt nie pracuje.</p>
                                @else
                                    @foreach($shifts as $shift)
                                        <p class="text-gray-600">
                                            <a class="text-lg text-gray-800 hover:underline" href="{{ route('edashboard.employees.edit', $shift->employee->id) }}">{{ $shift->employee->user->name }} ({{ $shift->employee->role->name }})</a>
                                            pracuje od {{ $shift->created_at->diffInHours() }}h {{ $shift->created_at->diffInMinutes() % 60 }}min.
                                        </p>
                                    @endforeach()
                                @endif
                            </div>
                        </div>
                        <div>
                            <p class="text-xl">Lista wszystkich zalogowań pracowników z dnia dzisiejszego</p>
                            <div class="mt-4">
                                @if(count($shifts_today) == 0)
                                    <p>Dziś jeszcze nikt się nie zalogował.</p>
                                @else
                                    @foreach($shifts_today as $shift)
                                        <p class="text-gray-600">
                                            <a class="text-lg text-gray-800 hover:underline" href="{{ route('edashboard.employees.edit', $shift->employee->id) }}">
                                                {{ $shift->employee->user->name }}
                                            </a>
                                            @if(isset($shift->ended_at))
                                                zalogowany od godz. {{ $shift->created_at->hour }}:{{ $shift->created_at->minute }} {{ $shift->ended_at ? 'do '. $shift->ended_at->hour.':'.$shift->ended_at->minute : '' }}.
                                            @else
                                                zalogowany od godz. {{ $shift->created_at->hour }}:{{ $shift->created_at->minute }}
                                            @endif
                                        </p>
                                    @endforeach()
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-employee-layout>
