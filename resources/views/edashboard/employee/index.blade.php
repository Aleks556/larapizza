<x-employee-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Zarządzanie pracownikami
            </h2>
            <div class="flex">
                <a class="mr-2" href="{{ route('edashboard.employees.create') }}">
                    <x-jet-secondary-button class="bg-green-500 text-white hover:text-green-100">Zatrudnij pracownika</x-jet-secondary-button>
                </a>
                <a class="mr-2" href="{{ route('edashboard.shifts') }}">
                    <x-jet-secondary-button>Zarządzanie zmianami</x-jet-secondary-button>
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
                <livewire:edashboard.employee.employee-index />
            </div>
        </div>
    </div>
</x-employee-layout>
