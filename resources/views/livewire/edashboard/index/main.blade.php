<div wire:poll.keep-alive="refreshPanel()" class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
    </div>

    <div class="mt-8 text-2xl">
        Szybki podgląd
    </div>

    <div class="mt-6 text-gray-500">
        Informacje dotyczące pracówników, zamówień, zgłoszeń i innych rzeczy z dnia dzisiejszego.
    </div>
    @if(session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif
    @if(!isset($shift->ended_at) and isset($shift->created_at))
        <div class="mt-6 text-gray-500 inline-flex">
            <p class="text-lg text-green-500 mr-2">Twoja zmiana rozpoczęła się: {{ $shift->created_at->toDateTimeString() }}</p>
            <x-jet-secondary-button wire:click="endShiftByEmployee()">Wyloguj się ze zmiany</x-jet-secondary-button>
        </div>
    @else
        <div class="mt-6 text-gray-500 inline-flex">
            <p class="text-lg text-red-500 mr-2">Nie jesteś zalogowany na dzisiejszą zmiane pracy!</p>
            <x-jet-secondary-button wire:click="startShift()">Zaloguj się</x-jet-secondary-button>
        </div>
    @endif
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('order.create') }}">Ilość dzisiejszych zamówień</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                W dniu dzisiejszym odebrano: {{ $today_orders_count }} {{ $orders_count_to_text }}.
            </div>

            <a href="{{ route('edashboard.orders_today') }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Przegląd zamówień</div>

                    <div class="ml-1 text-indigo-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('edashboard.employees') }}">Pracownicy</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Aktualnie jest {{ count($employees_on_shift) }} aktywnych pracowników
            </div>

            <a href="{{ route('edashboard.employees') }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Zarządzanie pracownikami</div>

                    <div class="ml-1 text-indigo-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('edashboard.reports') }}">Zgłoszenia do zamówień</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <p>Zgłoszenia dotyczące zamówień.</p>
                <p>W dniu dzisiejszym odebrano {{ $reports_count }} zgłoszeń dotyczących zamówień.</p>
            </div>

            <a href="{{ route('edashboard.reports') }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Podgląd zgłoszeń</div>

                    <div class="ml-1 text-indigo-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('edashboard.shifts') }}">Zarządzanie zmianą</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                W tej zakładce masz możliwość rozpoczęcia oraz zakończenia zmiany pracy jak i zarządzanie swoimi rekordami w grafiku.
            </div>

            <a href="{{ route('edashboard.shifts') }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Zarządzanie zmianą</div>

                    <div class="ml-1 text-indigo-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

