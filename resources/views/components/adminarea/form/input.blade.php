
<div class=" relative mb-5">
    <label for="name-with-label" class="font-bold mb-1 text-white block">
        {{$label}}
        @isset($required)
            <span class="text-red-500 required-dot">
                *
            </span>
        @endif
    </label>
    <input
        type="{{$type}}" id="name-with-label" wire:model="{{$name}}" placeholder="{{$placeholder}}" value="{{$value}}"
        class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-800"
        @isset($required)
            required="required"
        @endif
    />
</div>
