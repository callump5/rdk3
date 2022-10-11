<a 
    href="{{ $route ?? 'javascript:; '}}" 
    class="float-right block px-5 py-2 font-bold bg-zinc-900 rounded-2xl text-sm ml-4"
    @isset($id)
        id="{{$id}}"
    @endisset
    >
        <i class="fa-duotone fa-{{$icon}} mr-2"></i> 
        {{$text}}
</a>
