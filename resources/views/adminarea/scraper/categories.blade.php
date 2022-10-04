@extends('adminarea.layout')
@section('content')
    <div class="w-[55%] mx-auto my-5 ">
        <x-adminarea.partials.card>
            <livewire:adminarea.scraper.category-wizard></livewire:adminarea.scraper.category-wizard>
        </x-adminarea.partials.card>
    </div>
@endsection