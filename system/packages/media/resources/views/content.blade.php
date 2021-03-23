<div class="py-12" id="filemanager-content" data-pjax-containerx>
    <input id="folder_parent_id" type="hidden" value="{!! $root->id !!}">
    <div class="sm:px-6 lg:px-8">
        <div class="bg-white">
            <div class="col-span-12">
                <div class="flex justify-between p-2 bg-gray-200">
                    <div>
                        <x-button id="upload">Upload</x-button>
                        <input type="file" class="hidden" id="input-upload-file">
                        <x-button id="tnmedia-create-folder">Create folder</x-button>
                        <x-button id="filemanager-refresh">Refresh</x-button>
                    </div>
                    <div>
                        <x-input placeholder="Tìm kiếm"></x-input>
                    </div>
                </div>
            </div>
            <div class="col-span-12 border-b border-red-300">
                <div class="flex justify-between p-2 items-center">
                    <div>
                        {!! $breadcrumbs !!}
                    </div>
                    <div>
                        <x-button>Order</x-button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 px-2">
                <div class="col-span-9 py-2">
                    <div class="grid grid-cols-12 gap-3 sm:gap-6">
                        @if($root->id)
                            <div class="media-item rounded bg-white col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                                <div class="rounded-md relative">
                                    <div class="hidden hover:block bounce media-item-selected absolute right-0 top-0 mt-2 mr-2 h-6 w-6 bg-blue-500 z-10 rounded-full">
                                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"></path>
                                        </svg>
                                    </div>
                                    <a href="{!! route('media.index', ['folder' => implode(DIRECTORY_SEPARATOR, [$root->parent_folder])]) !!}" class="tnmedia-folder block tn-media-thumbnail relative w-full">
                                        <i data-feather="corner-up-left"></i>
                                    </a>
                                    <div class="tn-media-description">
                                        <div class="block font-medium py-1 text-center truncate">{!! $root->name !!}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @foreach($folders as $item)
                            <div class="media-item rounded bg-white col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                                <div class="rounded-md relative">
                                    <div class="hidden hover:block bounce media-item-selected absolute right-0 top-0 mt-2 mr-2 h-6 w-6 bg-blue-500 z-10 rounded-full">
                                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"></path>
                                        </svg>
                                    </div>
                                    <a href="{!! route('media.index', ['folder' => implode(DIRECTORY_SEPARATOR, [$item['parent_folder'], $item['name']])]) !!}" class="tnmedia-folder block tn-media-thumbnail relative w-full">
                                        <i data-feather="folder"></i>
                                    </a>
                                    <div class="tn-media-description">
                                        <div class="block font-medium py-1 text-center truncate">{!! $item['name'] !!}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach($items as $item)
                            <div class="media-item rounded bg-white col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                                <div class="rounded-md relative">
                                    <div class="hidden hover:block bounce media-item-selected absolute right-0 top-0 mt-2 mr-2 h-6 w-6 bg-blue-500 z-10 rounded-full">
                                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"></path>
                                        </svg>
                                    </div>
                                    <div class="tn-media-thumbnail relative w-full">
                                        <img src="{!! TnMedia::url($item['thumb']) !!}" alt="image">
                                    </div>
                                    <div class="tn-media-description">
                                        <div class="block font-medium py-1 text-center truncate">{!! $item['name'] !!}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="py-2">
                        {!! $files->links() !!}
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
<div
        id="tnmedia-create-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
        class="z-10 fixed w-full h-full top-0 left-0 flex items-center justify-center"
        style="display:none"
>
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex bg-gray-700 -mx-6 -my-4 py-4 px-6 text-white relative">
                <i data-feather="hexagon" class="text-white"></i>
                <span>&nbsp;Create folder</span>
                <div class="absolute top-4 right-4 cursor-pointer modal-close">
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!--Body-->
            <div class="text-center pt-3">
                <div class="py-3 flex">
                    <x-input
                        class="w-full rounded-tr-none rounded-br-none"
                        placeholder="Folder name"
                        id="folder-name"
                    />
                    <x-button id="tnmedia-create" class="rounded-tl-none rounded-bl-none">
                        Create
                    </x-button>
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
    .tn-media-thumbnail svg {
        width: 70%;
        height: 70%;
        left: 50%;
        top: 50%;
        position: absolute;
        transform: translate(-50%,-50%);
        -webkit-transform: translate(-50%,-50%);
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
    $(function(){
        const managerId = '#filemanager-content';
        $(managerId).on('click', '.media-item', function(e) {
            const parent = $(this).parent();
            parent.find('.media-item-selected').addClass('hidden');
            parent.find('.tn-media-description').removeClass('bg-blue-500');
            parent.find('.tn-media-description div').removeClass('text-white');

            $(this).find('.media-item-selected').toggleClass('hidden');
            $(this).find('.tn-media-description').toggleClass('bg-blue-500');
            $(this).find('.tn-media-description div').toggleClass('text-white');
        });

        $(managerId).on('click', '#upload', function(e) {
            $('#input-upload-file').click();
        })
        $(managerId).on('change', '#input-upload-file', function(e) {
            var formData = new FormData();
            formData.append("file[]", e.target.files[0]);
            formData.append("parent_id", $("#folder_parent_id").val());

            axios.post('{!! route('media.files.upload') !!}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(() => {
                $.pjax.reload('#filemanager-content');
            });
        })
        $(managerId).on('click', '#filemanager-refresh', function(e) {
            $.pjax.reload('#filemanager-content');
        })
        $(managerId).on('click', '.tnmedia-folder', function(e) {
            e.preventDefault();
            // $.pjax.reload('#filemanager-content');
        })
        $(managerId).on('dblclick', '.tnmedia-folder', function(e) {
            $.pjax({
                url: $(this).attr('href'),
                container: '#filemanager-content'
            });
        })

        $(managerId).on('click', '#tnmedia-create-folder', function(e) {
            console.log('click');
            $("#tnmedia-create-modal").show()
        })
        $('#tnmedia-create-modal').on('click', '.modal-close', function(e) {
            $("#tnmedia-create-modal").hide()
        })
        $('#tnmedia-create-modal').on('click', '#tnmedia-create', function(e) {
            axios.post('{!! route('media.folders.create') !!}', {
                name: $('#folder-name').val(),
                parent_id: $("#folder_parent_id").val()
            }).then(() => {
                $("#tnmedia-create-modal").hide();
                $.pjax.reload('#filemanager-content');
            });
        })

    });
</script>