<div class="group p-2 rounded-md lg:w-60 border-2 hover:border-gray-500">
    <div class="flex items-center justify-between group-hover:border-red-500">
        <p class="text-sm group-hover:border-red-500">
            {{ $slot }}
        </p>
        <svg class="w-4 h-4 group-hover:border-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </div>
</div>
