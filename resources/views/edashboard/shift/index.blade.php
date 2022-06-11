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

                <p class="text-lg">Lista pracowników aktualnie pracujących</p>
{{--                @foreach($employees as $employee)--}}
{{--                    <p>{{ $employee->user->name }} pracuje od {{ $employee->shift }}h.</p>--}}
{{--                @endforeach--}}

                @foreach($shifts as $shift)
                    <p> {{ $shift->employee->user->name }} pracuje od {{ $shift->created_at->diffInHours() }}h {{ $shift->created_at->diffInMinutes() }}min.</p>
                @endforeach()


{{--                <livewire:edashboard.employee.employee-index />--}}
                {{--                <livewire:edashboard.index.main />--}}
            </div>
        </div>
    </div>
</x-employee-layout>
