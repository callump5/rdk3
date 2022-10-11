<div class="h-screen hidden lg:block z-40 relative w-[250px] z-1000 bg-zinc-800 shadow-2xl shadow-black">
    <div class="h-full">
        <div class="flex p-6 border-zinc-900">
            <img src="{{asset('images/logos/redeem-keys-logo.png')}}" alt="Redeem Keys Logo" class="w-[90%]"/>
        </div>
        <nav class="">
            <div>
                @foreach($menu as $item)
                    <x-adminarea.partials.menu-item label="{{$item['label']}}" url="{{$item['url']}}" icon="{{$item['icon']}}"></x-adminarea.partials.menu-item>
                @endforeach
            </div>
        </nav>
    </div>
</div>

