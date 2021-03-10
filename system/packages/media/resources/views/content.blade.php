<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="bg-white">
            <div class="col-span-12">
                <div class="flex justify-between p-2 bg-gray-200">
                    <div>
                        <x-button id="upload">Upload</x-button>
                        <input type="file" class="hidden" id="input-upload-file">
                        <x-button>Create folder</x-button>
                        <x-button>Refresh</x-button>
                    </div>
                    <div>
                        <x-input placeholder="Tìm kiếm"></x-input>
                    </div>
                </div>
            </div>
            <div class="col-span-12 border-b border-red-300">
                <div class="flex justify-between p-2 items-center">
                    <div>
                        breadcurmbs
                    </div>
                    <div>
                        <x-button>Order</x-button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 px-2">
                <div class="col-span-9 pt-2">
                    <div class="grid grid-cols-12 gap-3 sm:gap-6">
                        @foreach([1,2,3,4,5,6,7,8,9,9,10] as $item)
                            <div class="media-item rounded bg-white col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                                <div class="rounded-md relative">
                                    <div class="hidden hover:block bounce media-item-selected absolute right-0 top-0 mt-2 mr-2 h-6 w-6 bg-blue-500 z-10 rounded-full">
                                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"></path>
                                        </svg>
                                    </div>
                                    <div class="tn-media-thumbnail relative w-full">
                                        <img src="https://hasa.botble.com/storage/news/1-150x150.jpg" alt="image">
                                    </div>
                                    <div class="tn-media-description">
                                        <div class="block font-medium py-1 text-center truncate">{!! $item !!}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="pt-2 col-span-3 gap-4 space-y-4 border-l border-red-300">
                    <div class="px-3">
                        <div class="rounded bg-white">
                            preview image
                        </div>

                    </div>
                    <div class="bg-white p-3">
                        info image
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @keyframes bounce {
        30%, 50%, 60%, 80%, 100% {transform: translateY(0);}
        0% {transform: scale(1.1);}
        20% {transform: scale(1.3);}
    }

    .bounce {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-name: bounce;
        animation-name: bounce;
    }

    .media-item-selected svg {
        width: 18px;
        margin-left: 3px;
        margin-top: 3px;
    }
    .tn-media-thumbnail:before {
        content: "";
        display: block;
        padding-bottom: 100%;
        height: 0;
    }
    .tn-media-thumbnail img {
        max-height: 100%;
        display: inline-block;
        position: absolute;
    }
    .tn-media-thumbnail img {
        width: auto;
        height: 100%;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
    }
</style>
<script>
    $(document).ready(function() {
        $(document).on('click', '.media-item', function(e) {
            const parent = $(this).parent();
            parent.find('.media-item-selected').addClass('hidden');
            parent.find('.tn-media-description').removeClass('bg-blue-500');
            parent.find('.tn-media-description div').removeClass('text-white');

            $(this).find('.media-item-selected').toggleClass('hidden');
            $(this).find('.tn-media-description').toggleClass('bg-blue-500');
            $(this).find('.tn-media-description div').toggleClass('text-white');
        });

        $(document).on('click', '#upload', function(e) {
            $('#input-upload-file').click();
        })
        $(document).on('change', '#input-upload-file', function(e) {
           console.log('change file_exists')
        })
    });
</script>