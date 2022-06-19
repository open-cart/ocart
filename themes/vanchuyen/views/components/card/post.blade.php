@props(['data' => null,'class' => '', 'type' => 'thumb-top', 'thumbnail' => true,'deps' => false, 'sizeImage' => 'medium', 'author' => false, 'postMeta' => true, 'classTitle' => 'md:text-base md:mb-2', 'categoryBg' => 'bg-red-500', 'ratio' => 0.594, 'contentgrow' => 1, 'categoryType' => 1, 'transform' => true, 'thumbRadius' => false, 'dark' => false, 'rounded' => 'rounded-md', 'video' => false ])
@if($data)
    <div class="card-post {{ $class }} @if($type === 'thumb-right' || $type === 'thumb-left') flex @endif @if($type === 'thumb-bottom') flex flex-col-reverse @endif @if($type === 'thumb-bg') thumb-bg flex relative @endif h-full relative overflow-hidden">
        @if($thumbnail)
            <div
                class="@if($type === 'thumb-right') flex-1 flex-shrink flex-grow order-2 @elseif($type === 'thumb-left') flex-1 flex-shrink flex-grow order-1 @endif @if($type === 'thumb-bg') w-full h-full @endif @if($thumbRadius) rounded-full @endif post-thumbnail effect"
                style="padding-bottom: calc( {{ $ratio }} * 100% );"
            >
                <a
                    href="{!! route(ROUTE_BLOG_POST_SCREEN_NAME, ['slug' => $data->slug]) !!}"
                    class="block"
                >
                    <img
                        class="w-full h-full object-cover {{ $rounded }} absolute lozad"
                        data-src="{{ TnMedia::getImageUrl($data->image, $sizeImage, asset('/images/no-image.jpg')) }}"
                        data-srcset="{{ TnMedia::getImageUrl($data->image . '?w=400', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl($data->image, $sizeImage, asset('/images/no-image.jpg')) }} 2000w"
                        src="{{ asset('/images/no-image.jpg') }}"
                        alt="{{ $data->name }}"
                    >
                </a>
                @if($video && !empty($data->code_video_youtube) )
                    <div class="post-video-icon">
                        <a
                            href="javascript:void(0)"
                            onclick="youtubeLink('{{ $data->code_video_youtube }}')"
                            data-toggle="modal"
                            data-target="#youtube-modal"
                            class="xts-icon xts-play_icon"
                        >
                            <x-theme::icons.play-button
                                class="w-5 h-5 text-blue-700"
                            />
                        </a>
                        <script>
                            function youtubeLink(code) {
                                console.log('Youtube Link', code)
                                $("#youtubeLink").attr('src', 'https://www.youtube.com/embed/' + code + '?autoplay=1');
                            }
                        </script>
                    </div>
                @elseif(!empty($data->code_video_youtube))
                    <div
                        class="format-icons"
                    >
                        <x-theme::icons.play-button
                            class="w-3 h-3 text-white-700"
                        />
                    </div>
                @endif

            </div>
        @endif
        <div
            class="@if($type === 'thumb-right') flex-1 flex-shrink order-1 pr-4 @elseif($type === 'thumb-left') flex-1 flex-shrink order-2 pl-4 @endif
            @if($type === 'thumb-top') py-2 md:py-4 @endif
            @if($type === 'thumb-bottom') pb-2 md:pb-4 @endif
            @if($type === 'thumb-bg') absolute flex-col flex-grow w-full h-full justify-end inline-flex pt6 pb-4 px-10 z-10 @endif
                post-content"
            style="flex-grow: {{ $contentgrow }}"
        >
            @if($data->categories->count() > 0)
                <div class="@if($thumbnail && $type === 'thumb-top' || $type === 'thumb-bg') absolute top-0 left-8 @endif inline-block">
                    <a
                        href="{!! route(ROUTE_BLOG_POST_CATEGORY_SCREEN_NAME, ['slug' => $data->categories->first()->slug]) !!}"
                        class="@if($categoryType === 1) {{ $categoryBg }} text-white rounded-b-md px-2 lg:px-5 py-0.5 lg:py-1 inline-flex @endif text-xs lg:uppercase font-bold hover:underline line-clamp-1"
                    >
                        <span class="@if($categoryType !== 1) mr-2 w-5 h-2.5 inline-block bg-blue-600 @endif"></span>
                        <span class="@if($categoryType !== 1) text-blue-600 @endif">{{ $data->categories->first()->name }}</span>
                    </a>
                </div>
            @endif

            <h3
                class="
                    @if($dark || $type === 'thumb-bg') text-white @endif
                    text-sm md:text-base font-bold line-clamp-2
                    {{ $classTitle }}"
            >
                <a
                    href="{!! route(ROUTE_BLOG_POST_SCREEN_NAME, ['slug' => $data->slug]) !!}"
                    class="hover:underline"
                >
                    {{ $data->name }}
                </a>
            </h3>
            @if($postMeta)
                <div class="@if($dark || $type === 'thumb-bg') text-white @else text-gray-600 @endif text-xs post-meta">
                    @if($author)
                        <span class="mr-2">
                    Admin
                </span>
                    @endif
                    <span class="inline-flex">
                <x-theme::icons.calendar class="inline-block mr-1"/>
                {{ $data->created_at->format('d/m/Y') }}
            </span>
                </div>
            @endif

            @if($deps)
                <div
                    class="@if($dark || $type === 'thumb-bg') text-white @else text-gray-500 @endif text-xs md:text-base line-clamp-2 md:line-clamp-3 my-2 py-0"
                >
                    {!! $data->description !!}
                </div>
            @endif
        </div>
    </div>
@endif
