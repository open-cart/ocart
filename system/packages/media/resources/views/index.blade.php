<x-app-layout>
{{--    {!! TnMedia::renderHeader() !!}--}}

{{--    {!! TnMedia::renderContent(compact('files', 'items', 'folders')) !!}--}}

{{--    {!! TnMedia::renderFooter() !!}--}}
    <div class="p-6">
        <div id="root" class="bg-white dark:text-gray-600"></div>
    </div>
    <link rel="stylesheet" href="/tnmedia/app.css"/>


{{--    <button id="show">select single</button>--}}
{{--    <button id="showm">select multiple</button>--}}
{{--    <link rel="stylesheet" href="{{ asset('tnmedia/app.css?v=' . time()) }}"/>--}}
{{--    <script src="{{ asset('tnmedia/bundle.js?v=1'. time()) }}"></script>--}}
    <script>
        TnMedia.default({
            id: 'root',
            popup: false,
            uploadAPI: '{!! route('media.files.upload') !!}',
            listAPI: '{!! route('media.list') !!}',
            createFolderAPI: '{!! route('media.folders.create') !!}',
            deleteAPI: '{{ route('media.delete') }}',
            renameAPI: '{{ route('media.rename') }}',
        })
        // $(document).on('pjax:send', function() {
        // })
    </script>
</x-app-layout>

{{--<script defer>--}}
{{--    $("#showm").click(function() {--}}
{{--        TnMedia.default({--}}
{{--            id: 'root',--}}
{{--            multiple: true,--}}
{{--            uploadAPI: '{!! route('media.files.upload') !!}',--}}
{{--            listAPI: '{!! route('media.list') !!}',--}}
{{--            close() {--}}
{{--            },--}}
{{--            insert(selected) {--}}
{{--                console.log(selected)--}}
{{--            }--}}
{{--        });--}}
{{--    })--}}
{{--    $("#show").click(function(){--}}
{{--        TnMedia.default({--}}
{{--            id: 'root',--}}
{{--            multiple: false,--}}
{{--            uploadAPI: '{!! route('media.files.upload') !!}',--}}
{{--            listAPI: '{!! route('media.list') !!}',--}}
{{--            close() {--}}
{{--            },--}}
{{--            insert() {--}}

{{--            }--}}
{{--        });--}}
{{--    })--}}

{{--    TnMedia.default({--}}
{{--        id: 'root',--}}
{{--        popup: false,--}}
{{--        uploadAPI: '{!! route('media.files.upload') !!}',--}}
{{--        listAPI: '{!! route('media.list') !!}',--}}
{{--    })--}}
{{--</script>--}}