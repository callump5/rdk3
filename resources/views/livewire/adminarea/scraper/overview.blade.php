<div class="w-full">
    <div class="flex flex-row py-2 mb-2 justify-between w-full  dark:text-white">
        <h2 class="text-2xl leading-tight">
            Scraper Overview
        </h2>
        <div class="relative flex items-center w-5/12 h-full group">
            <div class="absolute z-50 flex items-center justify-center block w-auto h-10 p-3 pr-2 text-sm text-gray-500 uppercase cursor-pointer sm:hidden">
                <svg fill="none" class="relative w-5 h-5" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
            <svg class="absolute left-0 z-20 hidden w-4 h-4 ml-4 text-gray-500 pointer-events-none fill-current group-hover:text-gray-400 sm:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                </path>
            </svg>
            <input type="text" wire:model="search.name" class="block w-full py-1.5 pl-10 pr-4 leading-normal rounded-2xl focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 ring-opacity-90 bg-gray-100 dark:bg-gray-800 text-gray-400 aa-input" placeholder="Search">
        </div>

        <div class="text-end flex">

            <button class="flex block w-full py-1.5 pl-4 pr-4  leading-normal rounded-2xl focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 ring-opacity-90 bg-gray-100 dark:bg-gray-800 text-gray-400 aa-input">
                Queue
                <span class="pl-2">
                    <x-adminarea.partials.fa-icon icon="browser"></x-adminarea.partials.fa-icon>
                </span>
            </button>

            <a href="/admin/scraper/games" class="flex block w-full py-1.5 pl-4 pr-4 mx-2 leading-normal rounded-2xl focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 ring-opacity-90 bg-gray-100 dark:bg-gray-800 text-gray-400 aa-input">
                Games
                <span class="pl-2">
                    <x-adminarea.partials.fa-icon icon="gamepad"></x-adminarea.partials.fa-icon>
                </span>
            </a>

            <a href="/admin/scraper/category" class="flex block w-full py-1.5 pl-4 pr-4 leading-normal rounded-2xl focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 ring-opacity-90 bg-gray-100 dark:bg-gray-800 text-gray-400 aa-input">
                Categories
                <span class="pl-2">
                    <x-adminarea.partials.fa-icon icon="list-tree"></x-adminarea.partials.fa-icon>
                </span>
            </a>
        </div>
    </div>

    <table class="w-full text-gray-600 dark:text-gray-200 justify-between py-3 text-left">

        <thead>
        <tr class="">
            <th class="w-[30px]"></th>
            <th class="py-4 px-2">Name</th>
            <th class="py-4 px-2">CD Keys Price</th>
            <th class="py-4 px-2">G2A Price</th>
            <th class="py-4 px-2 text-end">Last Updated</th>
        </tr>
        </thead>
        @foreach($games as $game)
            <tr class="">
                <td class="w-[30px]"><x-adminarea.partials.svg-tick id="{{ $game->id }}" name="{{ $game->name }}"></x-adminarea.partials.svg-tick></td>
                <td class="mx-4 p-2">{{$game->name}}</td>
                <td class="mx-4 p-2">£{{number_format($game->cdkeys_price, 2, '.', '.')}}</td>
                <td class="mx-4 p-2">£{{number_format($game->g2a_price, 2, '.', '.')}}</td>
                <td class="mx-4 p-2 text-end">{{$game->updated_at}}</td>
            </tr>
        @endforeach
    </table>
</div>
