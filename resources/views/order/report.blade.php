{{--@foreach($order_items as $order_item)--}}
{{--    <p>{{ $order_item->item->name }}</p>--}}
{{--@endforeach()--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Zgłoszenie zamówienia
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between text-center mb-2">
                        <a href="{{ route('orders') }}" class="text-sm inline-flex hover:underline group inset-0">
                            <svg class="w-4 group-hover fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                            Powrót
                        </a>
                        <div class="text-sm font-sans text-gray-300">
                            Data złożenia zamówienia: {{ $order->created_at }}
                        </div>
                        <div class="text-sm font-sans text-gray-300">
                            ID zamówienia: {{ $order->id }}
                        </div>
                    </div>
                    @if($available == 1)
                        <form method="POST" action="/orders/{{ $order->id }}/report/store">
                            @csrf
                            <label for="problem" class="block text-center mb-2 text-md font-semibold text-gray-900">Czego dotyczy problem?</label>
                            <select id="problem" name="problem" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Wybierz kategorię problemu</option>
                                {{--                            <option value="edit">Chcę edytować zamówienie</option>--}}
                                {{--                            <option value="incomplete">Zamówienie jest niekompletne</option>--}}
                                {{--                            <option value="badproducts">Błedne produkty w zamówieniu</option>--}}
                                {{--                            <option value="notarrived">Zamówienie nie dotarło do mnie</option>--}}
                                {{--                            <option value="badrest">Pracownik źle wydał resztę</option>--}}
                                <option value="1">Chcę edytować zamówienie</option>
                                <option value="2">Zamówienie jest niekompletne</option>
                                <option value="3">Błedne produkty w zamówieniu</option>
                                <option value="4">Zamówienie nie dotarło do mnie</option>
                                <option value="5">Pracownik źle wydał resztę</option>
                            </select>
                            @error('problem')
                                <p class="text-center text-md text-red-500">Nie wybrano tematu zgłoszenia zamówienia.</p>
                            @enderror
                            <label for="description" class="block text-center my-2 text-md font-medium text-gray-900">Opis sytuacji lub edycji <span class="text-sm text-gray-400">(opcjonalnie)</span></label>
                            <textarea name="description" type="text" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Prosimy opisać sytuację, pomoże nam to szybciej rozwiązać problem, który wystąpił."></textarea>
                            <div class="text-center p-6">
                                <x-jet-danger-button  type="submit" >Dodaj zgłoszenie</x-jet-danger-button>
                            </div>
                        </form>
                    @else
                        <p class="text-center text-3xl p-8 mx-auto text-red-500">Przepraszamy, ale to zamówienie zostało już zgłoszone.</p>
                        <p class="text-center">Poniżej znajdują się szczegóły zgłoszenia Twojego zamówienia</p>
                        @isset($report)
                            @foreach($report as $report_single)
                                <p class="text-center p-6 font-semibold">W zgłoszeniu został wybrany temat: {{ $report_single->getProblem() }} </p>
                                {{--                                @if(isset($report_single->description))--}}
                                {{--                                    @dd($report_single)--}}
                                <label for="description" class="block text-center my-2 text-md font-medium text-gray-900">Opis sytuacji / edycji</label>
                                <textarea name="description" id="description" class="mx-auto sm:mx-0 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  sm:w-full w-1/2 p-2.5" disabled>{{ $report_single->description ? $report_single->description : 'Nie wpisano dodatkowych informacji dotyczących sytuacji.' }}</textarea>
                                {{--                                @endif--}}
                                <p class="text-center py-2">Status zgłoszenia</p>
                                <p class="text-center font-semibold text-red-500">{{ $report_single->getStatusName() }}</p>
                            @endforeach
                        @endisset
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
