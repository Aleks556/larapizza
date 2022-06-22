<x-employee-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $employee->user->name }} - szczegóły pracownika
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('edashboard.employees.update', $employee->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="p-4 text-center grid place-items-center">
                        <p class="text-2xl font-bold tracking-tight">{{ $employee->user->name }} </p>
                        <div class="">
                            <div class="flex items-center p-2">
                                <p class="font-semibold mr-2">Stanowisko</p>
                                <select value="{{ $employee->role->level }}" id="role_id" name="role_id"
                                        class="form-control w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                                    @foreach($roles as $role)
                                        @if($employee->role->id == $role->id)
                                            <option value={{ $role->id }} selected="">{{ $role->name }}</option>
                                        @else
                                            <option value={{ $role->id }}>{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-sm">Nie określono stanowiska pracownika.</p>
                                @enderror
                            </div>
                            <div class="flex items-center p-2">
                                <p class="font-semibold mr-2">Student</p>
                                <select value="{{ $employee->student }}" id="student" name="student"
                                        class="form-control w-32 mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                                    @if($employee->student == 1)
                                        <option value="1" selected="selected">Tak</option>
                                        <option value="0">Nie</option>
                                    @else
                                        <option value="1">Tak</option>
                                        <option value="0" selected="selected">Nie</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-2">
                            <div class="justify-start p-2">
                                <p class="font-semibold">Data zatrudnienia</p>
                                <p>{{ $employee->created_at }}</p>
                                <p class="font-semibold">Numer telefonu</p>
                                <x-jet-input class="text-center" name="phone_number" value="{{ $employee->phone_number }}"></x-jet-input>
                                @error('phone_number')
                                 <p class="text-red-500 text-sm">Nie wprowadzono numeru telefonu pracownika.</p>
                                @enderror
                            </div>
                            <div class="justify-start p-2">
                                <p class="text-lg font-semibold">Miejsce zamieszkania</p>
                                <p> {{ $employee->address_street }} {{ $employee->address_number }} {{ $employee->address_flat ? ' / ' . $employee->address_flat : '' }}</p>
                                <p>{{ $employee->address_zipcode }} {{ $employee->address_city }}</p>
                                <p class="text-lg font-semibold">Ostatnia zmiana</p>
                                @if(isset($shift->created_at))
                                    <p>Od {{ $shift->created_at }} do {{ $shift->ended_at ?  : 'Nie zdefiniowano' }}</p>
                                @else
                                    <p>Jeszcze nigdy nie zalogowano na zmianę.</p>
                                @endif

                            </div>
                        </div>
                        <div class="sm:flex items-center justify-center">
                            @if(isset($shift->ended_at))
                                @if($shift->ended_by !== 0)
                                    <p class="text-green-500">Zmiana zakończona przez {{ auth()->user()->getName($shift->ended_by) }}.</p>
                                @else
                                    <p class="text-red-500">Zmiana zakończona automatycznie przez system.</p>
                                @endif
                            @else
                                <a class="sm:mr-2" href="{{ route('edashboard.employees.endshift', $employee->id) }}">
                                    <x-jet-secondary-button class="mx-auto text-white bg-green-600 hover:bg-green-500 hover:text-white">Zakończ zmianę</x-jet-secondary-button>
                                </a>
                            @endif
                            <x-jet-button class="mx-auto sm:mr-2" type="submit">Zapisz</x-jet-button>
                            <a href="{{ route('edashboard.employees.delete', $employee->id) }}">
                                <x-jet-danger-button class="my-2">Zwolnij pracownika</x-jet-danger-button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-employee-layout>
