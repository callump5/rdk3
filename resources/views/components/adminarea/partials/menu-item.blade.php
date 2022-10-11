<a href="/admin/{{$url}}"
   class="
       {{ request()->is('admin/' . $url . '*') ?
           'w-full text-white font-thin uppercase flex items-center p-4 my-2 transition-colors duration-200 justify-start bg-gradient-to-r from-zinc-900 to-zinc-900 border-r-4 border-[#F0AF01] dark:from-gray-700 dark:to-gray-800 border-r-3 border-[#F0AF01]':
           'w-full font-thin uppercase text-gray-400 dark:text-gray-200 flex items-center p-4 my-2 transition-colors duration-200 justify-start hover:text-blue-500'
       }}
   ">
    <span class="text-left">
        <i class="fa-duotone fa-{{$icon}}"></i>
    </span>
    <span class="mx-4 text-sm font-normal">
        {{$label}}
    </span>
</a>
