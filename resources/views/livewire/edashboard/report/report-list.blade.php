<div c class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="mt-8 text-2xl">
{{--        Zamówienia ({{ count($orders) }})--}}
    </div>

    <div class="mt-6 text-gray-500 mb-6">
{{--        @if(count($orders) == 0)--}}
{{--            Dzisiaj nie otrzymano jeszcze żadnego zamówienia.--}}
{{--        @else--}}
{{--            Lista zamówień z dnia dzisiejszego.--}}
{{--        @endif--}}
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr class="text-center">
                <th scope="col" class="px-6 py-3">
                    ID zgłoszenia
                </th>
                <th scope="col" class="px-6 py-3">
                    ID zamówienia
                </th>
                <th scope="col" class="px-6 py-3">
                    Nr telefonu
                </th>
                <th scope="col" class="px-6 py-3">
                    Typ problemu
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Opcje
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $report->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $report->order_id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $report->order->phone_number }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $report->getProblem() }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $report->getStatusName() }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="reports/{{ $report->id }}/edit" class="font-medium text-blue-600 hover:underline">Zarządzaj</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
