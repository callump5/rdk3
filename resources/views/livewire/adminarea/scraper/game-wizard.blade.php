<div class="mx-auto w-full">
    <div>

        <!-- Top Navigation -->
        <div class="border-b-2 py-4">
            <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight">Step: {{$currentStep}} of 3</div>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex-1">
                    <div @if($currentStep !== 1) style="display: none;" @endif  >
                        <div class="text-lg font-bold text-white leading-tight">Product Scraper Wizard</div>
                    </div>

                    <div @if($currentStep !== 2) style="display: none;" @endif >
                        <div class="text-lg font-bold text-white leading-tight">Review Data</div>
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
                    <label for="password" class="font-bold mb-1 text-white block">Product Name / Link</label>
                    <div class="text-gray-400 mt-2 mb-4">
                        Either enter the product name or the full link to the product
                    </div>

                    <div class="relative">
                        <input wire:model="url" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white font-medium dark:bg-gray-800" placeholder="Product URL" type="text">
                    </div>
                </div>

                <div class="mb-5">
                    <div class="font-bold mb-1 text-white block">
                        Select the scraper drivers
                    </div>
                    <div class="text-gray-400 mt-2 mb-4">
                        What sites to gather data from
                    </div>

                    <ul class="grid gap-6 w-full md:grid-cols-2">
                        <li>
                            <input type="checkbox" id="cdkeys" name="drivers" wire:model="drivers" value="cdkeys" class="hidden peer" required="">
                            <label for="cdkeys" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold"><img src="{{ asset('images/logos/cdkeys-logo.png')}}" alt="cdkeys logo"></div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="g2a" name="drivers" wire:model="drivers" value="g2a" class="hidden peer">
                            <label for="g2a" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold"><img src="{{ asset('images/logos/g2a-logo.png')}}" alt="cdkeys logo"></div>
                                </div>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                @if($currentStep !== 2) style="display: none;" @endif>


                <form wire:ignore>

                    <div class="flex mb-5 justify-between">

                        <div class="w-[40%]">
                            <img id="product_cover" src="{{ asset('images/placeholder.jpeg') }}">
                        </div>

                        <div class="w-[56%]">
                            <x-adminarea.form.input label="Product Name" type="text" name="scrapedData.name" placeholder="Enter Product Name" value="{{$scrapedData['name']}}" required="true"></x-adminarea.form.input>

                            <x-adminarea.form.input label="CD Keys Link" type="text" name="scrapedData.cdkeys_link" placeholder="Enter CD Keys Link" value="{{$scrapedData['cdkeys_link']}}" required="true"> </x-adminarea.form.input>

                            <x-adminarea.form.input label="CD Keys Price" type="number" name="scrapedData.cdkeys_price" placeholder="£2.43" value="{{$scrapedData['cdkeys_price']}}"></x-adminarea.form.input>

                            <x-adminarea.form.input label="G2A Link" type="text" name="scrapedData.g2a_link" placeholder="Enter G2A Link" value="{{$scrapedData['g2a_link']}}"> </x-adminarea.form.input>

                            <x-adminarea.form.input label="G2A Price" type="number" name="scrapedData.g2a_price" placeholder="£6.44" value="{{$scrapedData['g2a_price']}}"></x-adminarea.form.input>
                        </div>
                    </div>

                    <x-adminarea.form.textarea label="Description" name="scrapedData.description" name="scrapedData.description" placeholder="Enter Description" :value="$scrapedData['description']" > </x-adminarea.form.textarea>

                </form>

            </div>

            <div
                @if($currentStep !== 3) style="display: none;" @endif>

                <div class="mb-5">
                    <div class="dark:bg-gray-800 rounded-lg p-10 flex items-center shadow justify-between">
                        <div>
                            <svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>

                            <h2 class="text-2xl mb-4 text-white text-center font-bold">Product Created</h2>

                            <div class="text-gray-300 mb-8 text-center">
                                Thank you. We have sent you an email to demo@demo.test. Please click the link in the message to activate your account.
                            </div>

                            <div class="flex justify-between">
                                <a href="/admin/scraper/games" class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Start Again</a>
                                <a class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">View Game</a>

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
                        <button wire:click='scrapeProduct' class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                            Scrape
                        </button>
                    </div>
                @endif

                @if ($this->currentStep === 2)
                    <div class="w-1/2 text-right">
                        <button wire:click='createProduct' class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
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
                console.log('doit')
                let cpeditor = tinymce.init({
                    selector: '#tinymce-editor',
                    height: 500,
                    menubar: false,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'advcode', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'powerpaste', 'code'
                    ],
                    toolbar: 'undo redo | insert | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code',
                    powerpaste_allow_local_images: true,
                    powerpaste_word_import: 'prompt',
                    powerpaste_html_import: 'prompt',
                    skin: 'oxide-dark',
                    content_css: 'dark',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
                    toolbar_mode: 'floating',
                    setup: function (editor) {
                        editor.on('change', function (e) {
                        @this.set('scrapedData.description', editor.getContent() );
                        });
                    }
                });

                window.addEventListener('scrapeProduct', event => {
                    tinymce.activeEditor.setContent(event.detail.description);
                    $('#product_cover').attr('src', '/' + event.detail.imagePath)
                })

                window.addEventListener('scraperError', event => {
                    Swal.fire({
                        title: 'Error!',
                        text: event.detail.message,
                        icon: event.detail.type,
                        confirmButtonText: 'Cool'
                    })

                })
            })
        </script>

    @endpush
</div>


