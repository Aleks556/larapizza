<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="flex justify-between text-center mb-2">
                    <a href="{{ route('edashboard.reports') }}" class="text-sm inline-flex hover:underline group inset-0">
                        <svg class="w-4 group-hover fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                        Powrót
                    </a>
                    <div class="text-sm font-sans text-gray-300">
                        Data utworzenia: {{ $report->created_at }}
                    </div>
                    <div class="text-sm font-sans text-gray-300">
                        ID zgłoszenia: {{ $report->id }}
                    </div>
                </div>
                @if($report->edited_by !== 0)
                    <p class="text-red-500 mb-6">Ostatnia edycja była przeprowadzona {{ $report->updated_at->diffForHumans() }} przez {{ $editor_name }} </p>
                @endif
                <p class="text-center">Poniżej znajdują się szczegóły zgłoszenia zamówienia o ID: {{ $report->order->id }}</p>

                <p class="text-center p-6 font-semibold">W zgłoszeniu został wybrany temat: {{ $report->getProblem() }} </p>
                <label for="description" class="block text-center my-2 text-md font-medium text-gray-900">Opis sytuacji / edycji</label>
                <textarea name="description" id="description" class="mx-auto sm:mx-0 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  sm:w-full w-1/2 p-2.5" disabled>{{ $report->description ? $report->description : 'Nie wpisano dodatkowych informacji dotyczących sytuacji.' }}</textarea>
                <div class="text-center">
                    <x-jet-label>Status zgłoszenia:</x-jet-label>
                    <x-jet-dropdown align="none" dropdownClasses="relative lg:w-60" contentClasses="lg:w-60"  class="mb-5">
                        <x-slot name="trigger">
                            <x-dropdown-trigger>
                                @if($status === 0)
                                    Anulowane
                                @elseif($status === 1)
                                    Wysłane
                                @elseif($status === 2)
                                    Przyjęte - w trakcie postępowania
                                @elseif($status === 3)
                                    Zakończone
                                @endif
                            </x-dropdown-trigger>

                        </x-slot>
                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Dostępne statusy:
                            </div>
                            <x-jet-dropdown-link wire:click="setReportStatus(0)">Anulowane</x-jet-dropdown-link>
                            <x-jet-dropdown-link wire:click="setReportStatus(1)">Wysłane</x-jet-dropdown-link>
                            <x-jet-dropdown-link wire:click="setReportStatus(2)">Przyjęte - w trakcie postępowania</x-jet-dropdown-link>
                            <x-jet-dropdown-link wire:click="setReportStatus(3)">Zakończone</x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>
                    <x-jet-button wire:click="saveReport()">Zaktualizuj zgłoszenie</x-jet-button>
                    @if(session()->has('message'))
                        <p class="text-center p-3 text-green-500">{{ session('message') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
