<div class="p-2">
    <p class="text-md p-4">Wyszukaj pracownika</p>
    <div class="flex px-2">
        <x-jet-input wire:model="fullname_input"  class="border border-2 text-sm w-72 ml-2" placeholder="Imię i nazwisko pracownika"></x-jet-input>
        <x-jet-button wire:click="getEmployeeDetailsByName()" class="ml-2">Szukaj</x-jet-button>
        <x-jet-danger-button wire:click="clearNameInput()" class="ml-2">Wyczyść</x-jet-danger-button>
        @if(session('message'))
            <div class="ml-2 text-center text-white font-semibold bg-red-600 border text-sm items-center inset-0 p-2 rounded-md">{{ session('message') }}</div>
        @endif
        @if(isset($searched_employee))
{{--            @foreach($searched_employees as $searched_employee)--}}
{{--                @dd($searched_employee->id)--}}
                <div class="mx-2 items-center inline-flex inset-0">
                    <p class="">ID {{ $searched_employee->id }} {{ $searched_employee->user->name }}</p>
                    <p class="text-sm text-gray-400 mx-2">Dostawca</p>
                    <a href="{{ route('edashboard.employees.edit', $searched_employee->id) }}">
                        <x-jet-secondary-button>Zarządzaj</x-jet-secondary-button>
                    </a>
                </div>
{{--            @endforeach--}}
        @endif
    </div>

    <div class="mt-4 mx-4">
        <p class="text-lg mb-2">Lista pracowników</p>
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
                    Rola
                </th>
                <th scope="col" class="px-6 py-3">
                    Numer telefonu
                </th>
                <th scope="col" class="px-6 py-3">
                    Zalogowany?
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Opcje</span>
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    @if(isset($employee->role))
{{--                        @dd($employee)--}}
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $employee->id }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $employee->user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $employee->role->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $employee->phone_number}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $employee->shift_id ? 'Tak' : 'Nie' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="employees/{{ $employee->id }}/edit" class="font-medium text-blue-600 hover:underline">Szczegóły</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>



