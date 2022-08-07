<div class="h-screen hidden lg:block shadow-lg relative w-80 my-4 ml-4 ">
    <div class="bg-white h-full rounded-2xl  dark:bg-gray-700">
        <div class="flex items-center justify-center pt-6">
            <img src="{{asset('images/logos/redeem-keys-logo.png')}}" alt="Redeem Keys Logo" class="w-40"/>
        </div>
        <nav class="mt-6">
            <div>

                @foreach($menu as $item)
                    <x-adminarea.partials.menu-item label="{{$item['label']}}" url="{{$item['url']}}" icon="{{$item['icon']}}"></x-adminarea.partials.menu-item>
                @endforeach

            </div>
        </nav>
    </div>
</div>
