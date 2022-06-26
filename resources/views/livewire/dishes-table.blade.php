
<div class="text-center">

    @foreach($dish_categories as $category)
        <p class="text-2xl font-semibold py-2">{{ $category->name }}</p>
        @foreach($dishes as $dish)
            @if($category->id == $dish->category_id)
                <p>{{ $category->name }} {{ $dish->name }}</p>
            @endif
        @endforeach
    @endforeach
</div>

