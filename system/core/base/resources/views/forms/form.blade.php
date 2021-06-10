<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    <div class="pb-12">
        <div class="sm:px-6 lg:px-8">
            @if($showStart)
                {!! Form::open(Arr::except($formOptions, ['template'])) !!}
            @endif

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-9 space-y-4">
                    @if($errors->any())
                        <div x-data="{show: true}">
                            <div x-show="show" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">
                                    {!! $errors->first() !!}
                                </span>
                                <span x-on:click="show = !show" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                            </div>
                        </div>
                    @endif

                    @if ($showFields)
                    <div class="bg-white border border-white p-6 rounded-md space-y-4 dark:bg-gray-800 dark:border-gray-700">
                        @foreach ($fields as $key => $field)
                            @if ($field->getName() == $form->getBreakFieldPoint())
                                @break
                            @else
                                @unset($fields[$key])
                            @endif
                            @if( ! in_array($field->getName(), $exclude) )
                                {!! $field->render() !!}
                            @endif
                        @endforeach
                    </div>
                    @endif

                    @foreach ($form->getMetaBoxes() as $key => $metaBox)
                        {!! $form->getMetaBox($key) !!}
                    @endforeach

                    {!! do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'advanced', $form->getModel()) !!}
                </div>
                <div class="col-span-3 space-y-4">
                    {!! $form->getActionButtons() !!}
                    {!! do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'top', $form->getModel()) !!}

                    @foreach ($fields as $field)
                        @if( ! in_array($field->getName(), $exclude) )
                            <div class="rounded-md bg-white border border-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                                <div class="border-b p-3 flex justify-between dark:border-gray-700">
                                    <h4>{!! Form::customLabel($field->getName(), $field->getOption('label'), $field->getOption('label_attr')) !!}</h4>
                                </div>
                                <div class="px-3 py-6">
                                    {!! $field->render([], in_array($field->getType(), ['radio', 'checkbox'])) !!}
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {!! do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'side', $form->getModel()) !!}
                </div>

            </div>

            @if($showEnd)
                {!! Form::close() !!}
            @endif
            @yield('form_end')
        </div>
    </div>
    <script>
        $(function() {
            $("#from-builder").submit(function() {
                $.pjax.submit(event, '#body');
            });
            tinymce.remove();
            tinymce.init({
                selector: '.editor-inline',
                skin: 'dark',
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    });
                },
                height: 150,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code help wordcount',
                    'imagetools'
                ],
                mobile: {
                    theme: 'mobile'
                },
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | fullscreen help',
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tiny.cloud/css/codepen.min.css',
                    '/access/tinymce/skins/dark/dark-content.css'
                ],
                imagetools_toolbar: 'alignleft aligncenter alignright | imageoptions',
                'file_picker_callback': (cb, value, meta) => {
                    TnMedia.default({
                        id: 'tnmedia-root',
                        popup: true,
                        uploadAPI: '{!! route('media.files.upload') !!}',
                        listAPI: '{!! route('media.list') !!}',
                        insert: (items) => {
                            cb(items[0].full_url, {name: items[0].name, alt: items[0].name})
                        }
                    });
                },
            });
            tinymce.init({
                selector: '.editor-full',
                skin: 'dark',
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    });
                },
                height: 300,
                // theme: 'modern',
                mobile: {
                    theme: 'mobile'
                },
                plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
                toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | image link media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | fullscreen',
                image_advtab: true,
                imagetools_toolbar: 'alignleft aligncenter alignright | imageoptions',
                templates: [
                    { title: 'Test template 1', content: 'Test 1' },
                    { title: 'Test template 2', content: 'Test 2' }
                ],
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tiny.cloud/css/codepen.min.css',
                    '/access/tinymce/skins/dark/dark-content.css'
                ],
                'file_picker_callback': (cb, value, meta) => {
                    TnMedia.default({
                        id: 'tnmedia-root',
                        popup: true,
                        uploadAPI: '{!! route('media.files.upload') !!}',
                        listAPI: '{!! route('media.list') !!}',
                        insert: (items) => {
                            cb(items[0].full_url, {name: items[0].name, alt: items[0].name})
                        }
                    });
                },
            });
        })
    </script>
</x-app-layout>
