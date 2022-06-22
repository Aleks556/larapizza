
{{--<div wire:poll.keep-alive="setCategory({{ $current_category }})" class="m-6 max-w-lg mx-auto ">--}}
{{--    <div class="sm:hidden">--}}
{{--        <label for="tabs" class="sr-only">Wybierz kategorię pożywienia</label>--}}
{{--        <select id="tabs" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">--}}
{{--            @foreach($dish_categories as $category)--}}
{{--                <option>{{ $category->name }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
{{--    <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex">--}}
{{--        @foreach($dish_categories as $category)--}}
{{--            @if($loop->first)--}}
{{--                <li class="w-full">--}}
{{--                    @if($category->id == $current_category)--}}
{{--                        <button wire:click="setCategory({{$category->id}})" type="button" class="inline-block p-4 w-full text-white bg-red-500 border-2 border-gray-800 border-r-0 rounded-l-lg focus:outline-none hover:text-red-100 hover:bg-red-450" aria-current="page">--}}
{{--                            {{ $category->name }}--}}
{{--                        </button>--}}
{{--                    @else--}}
{{--                        <button wire:click="setCategory({{$category->id}})" type="button" class="inline-block p-4 w-full text-gray bg-white border-2 border-gray-800 border-r-0 rounded-l-lg focus:outline-none hover:text-gray-700 hover:bg-gray-50" aria-current="page">--}}
{{--                            {{ $category->name }}--}}
{{--                        </button>--}}
{{--                    @endif--}}

{{--                </li>--}}
{{--                @continue--}}
{{--            @endif--}}
{{--            @if($loop->iteration == $category->id && !$loop->last)--}}
{{--                <li class="w-full">--}}
{{--                    @if($category->id == $current_category)--}}
{{--                        <button wire:click="setCategory({{$category->id}})" type="button" class="inline-block p-4 w-full text-white border-2 border-gray-800 border-r-0 bg-red-500 hover:text-red-100 hover:bg-red-400 focus:outline-none">--}}
{{--                            {{ $category->name }}--}}
{{--                        </button>--}}
{{--                    @else--}}
{{--                        <button wire:click="setCategory('{{$category->id}}')" type="button" class="inline-block p-4 w-full bg-white border-2 border-gray-800 border-r-0 hover:text-gray-700 hover:bg-gray-50 focus:outline-none">--}}
{{--                            {{ $category->name }}--}}
{{--                        </button>--}}
{{--                    @endif--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if($loop->iteration == $category->id && $loop->last)--}}
{{--                <li class="w-full">--}}
{{--                    @if($category->id == $current_category)--}}
{{--                        <button wire:click="setCategory({{$category->id}})" type="button" class="inline-block p-4 w-full text-white border-2 border-gray-800 bg-red-500 rounded-r-lg hover:text-red-100 hover:bg-red-400 focus:outline-none ">--}}
{{--                            {{ $category->name }}--}}
{{--                        </button>--}}
{{--                    @else--}}
{{--                        <button wire:click="setCategory({{$category->id}})" type="button" class="inline-block p-4 w-full bg-white border-2 border-gray-800 rounded-r-lg hover:text-gray-700 hover:bg-gray-50 focus:outline-none ">--}}
{{--                            {{ $category->name }}--}}
{{--                        </button>--}}
{{--                    @endif--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--</div>--}}
<div class="text-center">

    @foreach($dish_categories as $category)
        <p class="text-2xl font-semibold py-2">{{ $category->name }}</p>
{{--        @if($current_category == $category->id)--}}
            @foreach($dishes as $dish)
                @if($category->id == $dish->category_id)
{{--                    @if($current_category == $category->id)--}}
                    <p>{{ $category->name }} {{ $dish->name }}</p>
{{--                    @endif--}}
                @endif

            @endforeach
{{--        @endif--}}

    @endforeach
{{--    @if(isset($sorted_dishes))--}}
{{--        @foreach($sorted_dishes as $dish)--}}
{{--            @if($dish['category_id'] == $current_category)--}}
{{--                <div class="p-6 my-2 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">--}}
{{--                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $dish->category->name }} <span class="font-medium">{{ $dish->name }}</h5>--}}
{{--                    <div class="flex items-center justify-between">--}}
{{--                        <p class=" font-normal text-gray-800">{{ $dish->portion }} za <span class="text-green-500">{{ $dish->price }} zł</span></p>--}}
{{--                        <button type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">--}}
{{--                            Do koszyka--}}
{{--                            <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endforeach--}}

{{--    @endif--}}
{{--    @if(isset($dishes))--}}
{{--        @foreach($dishes as $dish)--}}
{{--            @if($dish->category->id == $current_category)--}}

{{--                <div class="p-6 my-2 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">--}}
{{--                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $dish->category->name }} <span class="font-medium">{{ $dish->name }}</h5>--}}
{{--                    <div class="flex items-center justify-between">--}}
{{--                        <p class=" font-normal text-gray-800">{{ $dish->portion }} za <span class="text-green-500">{{ $dish->price }} zł</span></p>--}}
{{--                        <button type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">--}}
{{--                            Do koszyka--}}
{{--                            <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endforeach()--}}
{{--    @endif--}}
</div>

