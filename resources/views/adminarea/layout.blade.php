<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link type="text/css" rel="stylesheet" href="{{asset('css/app.css')}}">

    <link type="text/css" rel="stylesheet" href="{{asset('css/font-awesome/all.min.css')}}">

    <script src="{{asset('js/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.tiny.cloud/1/sbq05hsd76lwmf859kvsdplwni1ep3nf8k4d8m0usdgop8z4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    @livewireStyles
</head>
<body class="h-screen">

    <main class="bg-zinc-800 h-screen overflow-hidden relative">
        <div class="flex items-start justify-between">

            <x-adminarea.navigation></x-adminarea.navigation>

            <div class="flex flex-col w-full md:space-y-4">
                {{-- <x-adminarea.partials.header-bar></x-adminarea.partials.header-bar --}}

                <div class="overflow-auto h-screen p-10">
                    <div class="flex flex-col flex-wrap sm:flex-row ">

                        <div class="text-white w-[100%] p-5">
                            <div class="flex items-center pl-5 mb-10">
                                <!-- begin::Card Headers -->
                                <div class="w-[75%]">
                                    <h1 class="text-3xl leading-tight mb-3">{{$title}}</h1>

                                    @isset($description)
                                        <p class="opacity-80 text-sm">{{$description}}
                                        </p>
                                    @endisset
                                </div>
                                <!-- end::Card Header -->

                                <!-- begin::Card Actions -->
                                <div class="actions w-[60%] flex justify-end" >

                                    @stack('actions')
                                    @isset($actions)
                                        @foreach ($actions as $action)
                                            <x-adminarea.partials.pill-button text="{{ $action['text'] }}" icon="{{ $action['icon'] }}" route="{{ $action['route'] ?? 'javascript' }}" ></x-adminarea.partials.pill-button>
                                        @endforeach
                                    @endisset
                                </div>
                                <!-- end::Card Actions -->
                            </div>
                            
                            @yield('content')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @livewireScripts

    @stack('footer-scripts')

</body>

</html>
