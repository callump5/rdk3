<div class="mx-auto w-full">
    <div>

        <!-- Top Navigation -->
        <div class="border-b-2 py-4">
            <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight">Step: {{$currentStep}} of 3</div>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex-1">
                    <div @if($currentStep !== 1) style="display: none;" @endif  >
                        <div class="text-lg font-bold text-white leading-tight">Category Scraper Wizard</div>
                    </div>

                    <div @if($currentStep !== 2) style="display: none;" @endif >
                        <div class="text-lg font-bold text-white leading-tight">Select Products</div>
                    </div>

                    <div @if($currentStep !== 3) style="display: none;" @endif >
                        <div class="text-lg font-bold text-white leading-tight">Completed</div>
                    </div>
                </div>

                <div class="flex items-center md:w-64">
                    <div class="w-full bg-white rounded-full mr-2">
                        <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white transition-all ease-in" style="width: {{$progress}}%" ></div>
                    </div>
                    <div class="text-xs w-10 text-gray-300">{{number_format($progress, 0, '.', ',')}}%</div>
                </div>
            </div>
        </div>
        <!-- /Top Navigation -->

        <!-- Step Content -->
        <div class="py-10">
            <div
                @if($currentStep !== 1) style="display: none;" @endif>

                <div class="mb-10">


                    <!-- Category Link / Name -->
                    <div class="relative mb-[50px]">

                        <label for="password" class="font-bold mb-1 text-white block">Category Name / Link</label>
                        <div class="text-gray-400 mt-2 mb-4">
                            Either enter the product name or the full link to the product.</br> This will only work with CD Keys.
                        </div>

                        <input wire:model="formData.href" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-800" placeholder="Category URL" type="text">
                    </div>


                    <!-- Category Assignment -->
                    <div class="relative mb-[50px]">

                        <label for="password" class="font-bold mb-1 text-white block">Choose a Category</label>
                        <div class="text-gray-400 mt-2 mb-4">
                            Either enter the product name or the full link to the product.</br> This will only work with CD Keys.
                        </div>


                        <div class='rdk-autocomplete' class="relative">
  
                            <input wire:model="formData.category" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-800" placeholder="2" type="text">   
                            {{-- @dump($categories) --}}
                            @if(count($categories) > 0)
                                <ul class="absolute hidden z-40 w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-900 max-h-[100px] overflow-scroll">
                                    @foreach ($categories as $category)

                                        <li class="p-1 dark:hover:bg-gray-700 ">{{ $category->name }}</li>

                                    @endforeach 
                                </ul>
                            @endif
                        </div>

                    </div>



                    <!-- Platform Assignment -->
                    <div class="relative mb-[50px]">

                        <label for="password" class="font-bold mb-1 text-white block">Choose a Platform</label>
                        <div class="text-gray-400 mt-2 mb-4">
                            Either enter the product name or the full link to the product.</br> This will only work with CD Keys.
                        </div>


                        <div class='rdk-autocomplete' class="relative">
  
                            <input wire:model="formData.platform" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-800" placeholder="2" type="text">   
                            
                            @if(isset($platforms) && count($platforms) > 0)
                                <ul class="absolute hidden z-40 w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-900 max-h-[100px] overflow-scroll">
                                    @foreach ($platforms as $platforms)

                                        <li class="p-1 dark:hover:bg-gray-700 ">{{ $platforms->name }}</li>

                                    @endforeach 
                                </ul>
                            @endif
                        </div>

                    </div>





                    <!-- Collection Assignment -->
                    <div class="relative mb-[50px]">

                        <label for="password" class="font-bold mb-1 text-white block">Choose a Collection</label>
                        <div class="text-gray-400 mt-2 mb-4">
                            Either enter the product name or the full link to the product.</br> This will only work with CD Keys.
                        </div>


                        <div class='rdk-autocomplete' class="relative">
  
                            <input wire:model="formData.collection" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-800" placeholder="2" type="text">   
                            
                            @if(count($collections) > 0)
                                <ul class="absolute hidden z-40 w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-900 max-h-[100px] overflow-scroll">
                                    @foreach ($collections as $collection)

                                        <li class="p-1 dark:hover:bg-gray-700 ">{{ $collection->name }}</li>

                                    @endforeach 
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Number of Pages -->
                    <div class="relative">
                        <label for="password" class="font-bold mb-1 text-white block">Number of pages</label>
                        <div class="text-gray-400 mt-2 mb-4">
                            This will be how many of the results pages to loop through
                        </div>
                        
                        <input wire:model="formData.pages" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-800" placeholder="2" type="text">
                    </div>
                </div>
            </div>

            <div
                @if($currentStep !== 2) style="display: none;" @endif
                >
{{--            @dump($updateList) --}}

                <table class="w-full text-gray-600 dark:text-gray-200 justify-between py-3 text-left">

                    <thead>
                    <tr class="">
                        <th class="w-[30px]"></th>
                        <th class="py-4 px-2">Name</th>
                    </tr>
                    </thead>
                    @isset($games)
                        @foreach($games as $key => $game)
                            <tr class="">
                                <td class="w-[30px]"><x-adminarea.partials.svg-tick id="{{ $key }}" name="{{ $game['name'] }}"></x-adminarea.partials.svg-tick></td>
                                <td class="mx-4 p-2">{{$game['name']}}</td>
                            </tr>
                        @endforeach
                    @endisset
                </table>

            </div>

            <div
                @if($currentStep !== 3) style="display: none;" @endif
                >

                <div class="mb-5">
                    <div class="dark:bg-gray-800 rounded-lg p-10 flex items-center shadow justify-between">
                        <div>
                            <svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>

                            <h2 class="text-2xl mb-4 text-white text-center font-bold">Product Creation Queued</h2>

                            <div class="text-gray-300 mb-8 text-center">
                                The products have been added to the queue to scrape, check back in 10 minutes to make sure they have been created correctly.
                            </div>

                            <div class="flex justify-between">
                                <a href="/admin/scraper/games" class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Start Again</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Step Content -->


        @if($currentStep !== $steps)
            <div class="flex justify-between">
                <div class="w-1/2">
                    <button wire:click='previousStep' class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Previous</button>
                </div>

                @if ($this->currentStep === 1)
                    <div class="w-1/2 text-right">
                        <button id='scrapeCategory' class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                            Scrape
                        </button>
                    </div>
                @endif

                @if ($this->currentStep === 2)
                    <div class="w-1/2 text-right">
                        <button wire:click='queueProductsToScrape' class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                            Complete
                        </button>
                    </div>
                @endif



            </div>
        @endif
    </div>
    @push('footer-scripts')
        <script type="text/javascript">
            jQuery(function($) {

                $('#scrapeCategory').click(function(){
                    Swal.showLoading();

                    Livewire.emit('scrapeCategory');
                });

                window.addEventListener('scraperError', event => {
                    Swal.fire({
                        title: 'Error!',
                        text: event.detail.message,
                        icon: event.detail.type,
                        confirmButtonText: 'Cool'
                    })
                })

                
                window.addEventListener('toggleLoader', event => {
                    console.log(event.detail.status );
                    
                    if(event.detail.status === 'finished'){
                        Swal.hideLoading(); //
                        Swal.close()
                    } else {
                        Swal.showLoading();
                    }
                })




                
    
                $('.rdk-autocomplete ul li').click(function(i, e ){

                    var input = $(this).parents('.rdk-autocomplete').find('input');

                    input.val($(this).text())
                    @this.set(input.attr('wire:model'), $(this).text() );

                    })
                })

        </script>

    @endpush
</div>


