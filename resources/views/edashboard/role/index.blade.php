<x-employee-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Zarządzanie stanowiskami
            </h2>
            <a href="{{ route('edashboard.role.create') }}"><x-jet-secondary-button>Nowe stanowisko</x-jet-secondary-button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="mt-4 mx-4">
                    <p class="text-lg mb-2">Lista stanowisk</p>

                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nazwa stanowiska
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Poziom uprawnień
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stawka
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Liczba osób
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Opcje</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $role->id }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $role->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $role->level }} poziom
                                </td>
                                <td class="px-6 py-4">
                                    {{ $role->pay_rate }} zł / godz.
                                </td>
                                <td class="px-6 py-4">
                                    {{ $role->getAmountOfMembers($role->id) }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="roles/{{ $role->id }}/edit" class="font-medium text-blue-600 hover:underline">Szczegóły</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-employee-layout>
