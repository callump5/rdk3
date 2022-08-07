@extends('adminarea.layout')
@section('content')


    <div class="w-full">
        <div class="mb-4">
            <x-adminarea.partials.card>
                <livewire:adminarea.scraper.overview></livewire:adminarea.scraper.overview>
            </x-adminarea.partials.card>
        </div>
    </div>

@endsection
