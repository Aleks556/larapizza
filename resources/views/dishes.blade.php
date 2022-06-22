<x-guest-layout>
    <x-guest-navigation-menu />
    <div class="sm:flex justify-center items-center mt-4 border-t p-6">
        <div class="text-center mr-6 mt-4">
            <p class="text-4xl font-semibold text-gray-800">Poznaj nasze menu!</p>
            <p class="whitespace-pre-line">
                Wszystkie dania są wykonane z niezwykle dużą dbałością o detale.
            </p>
        </div>
    </div>
    <div class="max-w-lg mx-auto sm:px-6 lg:px-8 border border-y-2 border-x-0 sm:border-2 border-gray-800  bg-red-500 sm:rounded-md">
        <p class="p-2 text-center text-white font-light text-2xl">Menu</p>
    </div>
    <livewire:dishes-table />
    <x-footer class="fixed-bottom"/>
</x-guest-layout>

