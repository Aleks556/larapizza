<x-guest-layout>
    <x-guest-navigation-menu/>
    <div class="md:flex justify-center items-center mt-4 border-t p-6">
        <div class="text-center mr-6 mt-4">
            <p class="text-4xl font-semibold text-gray-800">LaraPizza wreszcie otwarte!</p>
            <p class="whitespace-pre-line">
                Jeśli nie posiadasz jeszcze u nas konta to nie zwlekaj!
                Zamów danie i ciesz się smakiem!
            </p>

            <a href="{{ route('order.create') }}">
                <x-jet-danger-button class="mt-4">Sprawdź</x-jet-danger-button>
            </a>
        </div>
        <img class="hidden sm:block sm:w-1/3 sm:mt-2 rounded-full" src={{ URL::asset('/images/img_banner1.jpg') }}>
    </div>
    <div class="text-center mx-auto mb-12 lg:px-20">
        <h2 class="text-2xl leading-normal mb-2 font-bold text-black">
            Dlaczego warto skorzystać z naszych usług?
        </h2>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60" style="margin: 0 auto;height: 35px;" xml:space="preserve">
                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary" style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
            <line x1="55.1" y1="30.4" x2="100" y2="30.4" class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
            <line x1="45.1" y1="30.4" x2="0" y2="30.4" class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
            </svg>
        <p class="text-gray-500 leading-relaxed font-light text-xl mx-auto pb-2">Oto parę powodów dlaczego.</p>
    </div>
    <div class="flex flex-wrap flex-row -mx-4 text-center">
        <div class="flex-shrink px-4 max-w-full w-full sm:w-1/2 lg:w-1/3 lg:px-6 wow fadeInUp" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
            <!-- service block -->
            <div class="py-8 px-12 mb-12 bg-gray-50 border-b border-gray-100 transform transition duration-300 ease-in-out hover:-translate-y-2">
                <div class="inline-block text-gray-900 mb-4">
                    <!-- icon -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg leading-normal mb-2 font-semibold text-black">Czas</h3>
                <p class="text-gray-500">Staramy się, aby każde zamówienie trafiło jak najszybciej oraz bezproblemowo.</p>
            </div>
            <!-- end service block -->
        </div>
        <div class="flex-shrink px-4 max-w-full w-full sm:w-1/2 lg:w-1/3 lg:px-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">
            <!-- service block -->
            <div class="py-8 px-12 mb-12 bg-gray-50 border-b border-gray-100 transform transition duration-300 ease-in-out hover:-translate-y-2">
                <div class="inline-block text-gray-900 mb-4">
                    <!-- icon -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-lg leading-normal mb-2 font-semibold text-black">Kontakt</h3>
                <p class="text-gray-500">Czy jest problem czy nie klient zawsze ma dobrą możliwość skontaktowania się z nami.</p>
            </div>
            <!-- end service block -->
        </div>
        <div class="flex-shrink px-4 max-w-full w-full sm:w-1/2 lg:w-1/3 lg:px-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
            <!-- service block -->
            <div class="py-8 px-12 mb-12 bg-gray-50 border-b border-gray-100 transform transition duration-300 ease-in-out hover:-translate-y-2">
                <div class="inline-block text-gray-900 mb-4">
                    <!-- icon -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-lg leading-normal mb-2 font-semibold text-black">Swieże składniki</h3>
                <p class="text-gray-500">Świeże składniki to dla nas podstawa, dlatego codziennie przeprowadzane są kontrole jakości produktów.</p>
            </div>
            <!-- end service block -->
        </div>
    </div>
    <x-footer />
</x-guest-layout>
