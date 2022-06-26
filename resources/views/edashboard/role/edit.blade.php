<x-employee-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modyfikacja stanowiska
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="flex p-6">
                    <form method="POST" action="/edashboard/roles/{{ $role->id }}">
                        @csrf
                        @method('PATCH')
                        <x-jet-label for="name">Nazwa stanowiska</x-jet-label>
                        <x-jet-input id="name" name="name" type="text" class="text-sm mb-2" value="{{ old('name', $role->name) }}"></x-jet-input>
                        @error('name')
                            <p class="text-center text-md text-red-500">Nieprawidłowa nazwa stanowiska lub już jest zajęta.</p>
                        @enderror
                        <x-jet-label for="level">Poziom uprawnień</x-jet-label>
                        <select value="{{ old('level', $role->level) }}" id="level" name="level" class="form-control mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                            <option value="">Poziom uprawnień</option>
                            <option value="1">1 poziom</option>
                            <option value="2">2 poziom</option>
                            <option value="3">3 poziom</option>
                        </select>
                        @error('level')
                            <p class="text-center text-md text-red-500">Nie wybrano poziomu uprawnień.</p>
                        @enderror
                        <x-jet-label for="pay_rate">Stawka na godzinę</x-jet-label>
                        <x-jet-input id="pay_rate" name="pay_rate" type="number" value="{{ old('pay_rate', $role->pay_rate) }}" class="mb-2 text-sm"></x-jet-input>
                        @error('pay_rate')
                            <p class="text-center text-md text-red-500">Nie ustawiono stawki zarobku na godzinę.</p>
                        @enderror
                        <div class="text-center p-6">
                            <x-jet-secondary-button type="submit" >Zaktualizuj</x-jet-secondary-button>
                        </div>
                    </form>
                    <div class="ml-12">
                        <p class="text-lg font-semibold">Osoby pracujące na tym stanowisku</p>
                        @if(count($employees) == 0)
                            <p class="mt-6 text-center text-red-500">Nikt nie pracuje na tym stanowisku.</p>
                        @else
                            <div class="mt-6">
                                @foreach($employees as $employee)
                                    <p class="text-center"> {{$employee->user->name}} <span class="text-sm text-gray-400 hover:underline"><a href="/edashboard/employees/{{ $employee->id }}/edit">Szczegóły</a> </span> </p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-employee-layout>
