<footer class="p-4 bg-white rounded-lg shadow md:px-6 md:py-8">
    <div class="sm:flex items-center justify-between">
        <div class="flex flex-wrap items-center">
            <x-logo />
        </div>
        <ul class="mt-6 sm:flex flex-wrap items-center text-sm text-gray-500 sm:mb-0">
            <li>
                <a href="{{ route('welcome') }}" class="mr-4 hover:underline md:mr-6 ">Strona główna</a>
            </li>
            <li>
                <a href="{{ route('dishes') }}" class="mr-4 hover:underline md:mr-6">Menu</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">Kontakt</a>
            </li>
        </ul>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8">
    <span class="block text-sm text-gray-500 sm:text-center">© 2022 <a href="{{ route('welcome') }}" class="hover:underline">LaraPizza</a>. Wszelkie prawa zastrzeżone.</span>
</footer>
