<x-employee-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Zarządzanie zamówieniem
        </h2>
    </x-slot>

    <livewire:edashboard.order.order-edit/>

{{--    @dd(request()->order->id)--}}
{{--    @livewire('edashboard.order.order-edit', ['order' => request()->order])--}}
</x-employee-layout>


