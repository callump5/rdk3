@extends('adminarea.layout')
@section('content')
    <div class="w-[55%] mx-auto my-5 ">
        <x-adminarea.partials.card>
            <livewire:adminarea.scraper.game-wizard></livewire:adminarea.scraper.game-wizard>
        </x-adminarea.partials.card>
    </div>
@endsection
