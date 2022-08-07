<a href="/admin/{{$url}}"
   class="

       {{ request()->is('admin/' . $url . '*') ?
           'w-full font-thin uppercase text-blue-500 flex items-center p-4 my-2 transition-colors duration-200 justify-start bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 dark:from-gray-700 dark:to-gray-800 border-r-4 border-blue-500':
           'w-full font-thin uppercase text-gray-500 dark:text-gray-200 flex items-center p-4 my-2 transition-colors duration-200 justify-start hover:text-blue-500'
       }}
   ">

    <span class="text-left">
        <i class="fa-duotone fa-{{$icon}}"></i>
    </span>
    <span class="mx-4 text-sm font-normal">
        {{$label}}
    </span>
</a>
