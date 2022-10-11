<div>
    <table class="bg-zinc-800 rounded-lg text-left w-[100%] ">
           
        <tbody>
            @foreach($games as $game)
                <tr>
                    <td class="px-5 py-2 w-[100px]"><img class="w-[100px]" src="{{ $game->image_path }}" alt="Game Thumbnail"></td>
                    <td class="pr-5 py-2">
                        <b>{{ $game->name }}</b>
                        <p class="text-sm opacity-60">{{ $game->excerpt() }}</p>
                    </td>
                    <td class="pr-5 py-2 align-center align-middle">
                        
                        <div class="flex">

                            @if(isset($game->cdkeys_price) && $game->cdkeys_price > 0)
                            <div class="inline-flex items-center justify-between px-4 py-1 w-[150px] bg-[#302254] rounded-3xl mr-3">
                                <img width="66px" class="mr-1 top-[2px] relative"  src="{{asset('images/logos/cdkeys-logo.png')}} ">
                                <span class='text-sm'>£{{ $game->cdkeys_price }}.00</span>
                            </div>
                            @endif

                            @if(isset( $game->g2a_price ) && $game->g2a_price > 0)
                            <div class="inline-flex items-center justify-between px-4 py-1 w-[150px] bg-[#E95C00] rounded-3xl">
                                <img width="52px" class="mr-1  brightness-0 invert" src="{{asset('images/logos/g2a-logo.png')}} ">
                                <span class='text-sm'>£{{ $game->g2a_price }}.00</span>
                            </div>
                            @endif

                        </div>
                        <!-- #E95C00<a class="block px-5 py-2 font-bold bg-blue rounded-2xl text-sm"><i class="fad fa-pound-sign"></i> {{ $game->g2a_price }}.00</a> -->
                    </td>
                    <!-- <td class="px-5 py-2">{{ $game->description }}</td> -->
                    <td class="px-5 py-2"> 
                        <a href="{{ route('games.create') }}" class="float-right block rounded-2xl ml-4"><i class="fa-duotone fa-trash"></i></a>
                        <a href="{{ route('games.edit', $game->id) }}" class="float-right block rounded-2xl mr-4"><i class="fa-duotone fa-wrench"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div wire:ignore id='model-search' class="hidden justify-center items-center fixed top-0 left-0 right-0 bottom-0 bg-[#00000090]">
        <div class="bg-zinc-800 px-6 py-6 block text-lg"> 
            <i class="fa-duotone fa-magnifying-glass mr-4" style='--fa-primary-color: #ffffff; --fa-secondary-color: #ffffff'></i> 
            <input type="text" placeholder="Search...." wire:model.debounce.500ms="search.name" class="bg-transparent focus-visible:border-0 active:border-0" > 
        </div>
        <input type="submit" value="submit" class="hidden">
    </div>
</div>
