<div wire:ignore>
    <div class=" relative " wire:ignore >
        <label for="name-with-label" class="font-bold mb-1 text-white block">
            {{$label}}
        </label>

        <textarea id="tinymce-editor"  wire:model="{{$name}}" placeholder="{{$placeholder}}">
            {{$value}}
        </textarea>
    </div>
</div>
