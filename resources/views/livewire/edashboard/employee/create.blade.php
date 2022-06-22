<div>
    @if(session('message'))
        <div class="text-center text-white font-semibold bg-red-600 border text-sm items-center inset-0 p-2 rounded-md">{{ session('message') }}</div>
    @endif
    <x-jet-label>Wprowadź email użyty podczas tworzenia konta użytkownika, którego chcesz zatrudnić.</x-jet-label>
    <div class="sm:flex items-center">
        <x-jet-input wire:model="email" class="mx-2 border border-gray-800 text-sm"/>

        <x-jet-button wire:click="getUserByEmail()">Połącz</x-jet-button>

        @if(session('email_message'))
            <p class="ml-2 text-sm">{{ session('email_message') }}</p>
        @endif
    </div>
        @error('found_user')
            <p class="text-sm text-red-500">Nie połączono konta użytkownika do przyszłego profilu pracownika.</p>
        @enderror
    <x-jet-label>Numer telefonu</x-jet-label>
    <x-jet-input wire:model="phone_number" class="mx-2 border border-gray-800 text-sm"/>
    @error('phone_number')
        <p class="text-sm text-red-500">Wprowadzono nieprawidłowy numer telefonu.</p>
    @enderror

    <div class="p-2">
        <x-jet-label>Nazwa ulicy</x-jet-label>
        <x-jet-input wire:model="address_street" class="mx-2 border border-gray-800 text-sm"/>
        @error('address_street')
        <p class="text-sm text-red-500">Wprowadzono nieprawidłową nazwę ulicy.</p>
        @enderror

        <x-jet-label>Numer budynku</x-jet-label>
        <x-jet-input wire:model="address_number" class="mx-2 border border-gray-800 text-sm"/>
        @error('address_number')
        <p class="text-sm text-red-500">Wprowadzono nieprawidłowy numer budynku.</p>
        @enderror

        <x-jet-label>Numer lokalu</x-jet-label>
        <x-jet-input wire:model="address_flat" class="mx-2 border border-gray-800 text-sm"/>

        <x-jet-label>Kod pocztowy</x-jet-label>
        <x-jet-input wire:model="address_zipcode" class="mx-2 border border-gray-800 text-sm"/>
        @error('address_zipcode')
        <p class="text-sm text-red-500">Wprowadzono nieprawidłowy kod pocztowy.</p>
        @enderror

        <x-jet-label>Miejscowość / miasto</x-jet-label>
        <x-jet-input wire:model="address_city" class="mx-2 border border-gray-800 text-sm"/>
        @error('address_city')
        <p class="text-sm text-red-500">Wprowadzono nieprawidłową nazwę miejscowości.</p>
        @enderror
    </div>
        <x-jet-label>Stanowisko</x-jet-label>
        <x-jet-dropdown align="none" dropdownClasses="relative lg:w-60" contentClasses="lg:w-60"  class="mb-5">
            <x-slot name="trigger">
                <x-dropdown-trigger>
                    @if($role === 0)
                        Wybierz
                    @endif
                    @foreach($db_roles as $db_role)
                        @if($db_role->id == $role)
                            {{ $db_role->name }}
                        @endif
                    @endforeach
{{--                    @elseif($role === 1)--}}
{{--                        Dostawca--}}
{{--                    @elseif($role === 2)--}}
{{--                        Kucharz--}}
{{--                    @elseif($role === 3)--}}
{{--                        Menadżer--}}
{{--                    @endif--}}
                </x-dropdown-trigger>

            </x-slot>
            <x-slot name="content">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    Dostępne stanowiska
                </div>
                    @foreach($db_roles as $db_role)
                        <x-jet-dropdown-link wire:click="setRole({{ $db_role->id }})">{{ $db_role->name }}</x-jet-dropdown-link>
                    @endforeach
{{--                <x-jet-dropdown-link wire:click="setRole(0)">Wybierz</x-jet-dropdown-link>--}}
{{--                <x-jet-dropdown-link wire:click="setRole(1)">Dostawca</x-jet-dropdown-link>--}}
{{--                <x-jet-dropdown-link wire:click="setRole(2)">Kucharz</x-jet-dropdown-link>--}}
{{--                <x-jet-dropdown-link wire:click="setRole(3)">Menadżer</x-jet-dropdown-link>--}}
            </x-slot>
        </x-jet-dropdown>
        @error('role')
            <p class="text-sm text-red-500">Nie wybrano stanowiska pracownika.</p>
        @enderror
        <x-jet-dropdown align="none" dropdownClasses="relative lg:w-60" contentClasses="lg:w-60"  class="mb-5">
            <x-slot name="trigger">
                <x-dropdown-trigger>
                    @if(!isset($student))
                        Wybierz
                    @elseif($student === 0)
                        Nie
                    @elseif($student === 1)
                        Tak
                    {{--                    @elseif($role === 3)--}}
                    {{--                        Menadżer--}}
                    @endif
                </x-dropdown-trigger>

            </x-slot>
            <x-slot name="content">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    Dostępne odpowiedzi
                </div>

                <x-jet-dropdown-link wire:click="setStudent(0)">Nie</x-jet-dropdown-link>
                <x-jet-dropdown-link wire:click="setStudent(1)">Tak</x-jet-dropdown-link>
                {{--                <x-jet-dropdown-link wire:click="setRole(2)">Kucharz</x-jet-dropdown-link>--}}
                {{--                <x-jet-dropdown-link wire:click="setRole(3)">Menadżer</x-jet-dropdown-link>--}}
            </x-slot>
        </x-jet-dropdown>
        @error('student')
            <p class="text-sm text-red-500">Nie określono czy przyszły pracownik jest studentem.</p>
        @enderror

    <x-jet-button wire:click="addEmployee()">Dodaj pracownika</x-jet-button>
</div>
