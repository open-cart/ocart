<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom mb-4">
        <ol class="list-reset py-4 border-b border-gray-200 flex text-grey">
            <li class="pr-2"><a href="{!! route('home') !!}" class="no-underline text-blue-600">Home</a></li>
            <li>/</li>
            @if(count($post->categories)>0)
                <li class="px-2 line-clamp-1"><a href="{!! route(ROUTE_BLOG_POST_CATEGORY_SCREEN_NAME, ['slug' => Arr::get($post->categories->first(), 'slug')]) !!}" class="no-underline text-blue-600">{{ Arr::get($post->categories->first(), 'name') }}</a></li>
                <li>/</li>
            @endif
            <li class="px-2 line-clamp-1"><span class="no-underline text-gray-500">{{ $post->name }}</span></li>
        </ol>
    </div>

    <div class="container-custom flex flex-wrap pb-2">
        <div class="lg:w-3/4 w-full md:order-last px-0 lg:pl-4">
            @if(!empty($post->code_video_youtube))
                <div class="mb-8" style="height: 550px">
                    <iframe
                        class="w-full h-full border border-solid border-grey-500"
                        src="https://www.youtube.com/embed/{{ $post->code_video_youtube }}">
                    </iframe>
                </div>
            @endif
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-blue-600 font-bold">{{ $post->name }}</h1>
            </div>
            @if($post->description)
                <div class="mb-4 p-4 bg-gray-100 rounded-md">
                    {!! $post->description !!}
                </div>
            @endif

            <div class="block mb-4 relative" style="padding-bottom: calc( 0.594 * 100% );">
                <img
                    class="w-full lozad rounded-md absolute h-full"
                    data-src="{{ TnMedia::getImageUrl($post->image, 'medium', asset('/images/no-image.jpg')) }}"
                    data-srcset="{{ TnMedia::getImageUrl($post->image, 'medium', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl($post->image, 'large', asset('/images/no-image.jpg')) }} 2000w"
                    src="{{ asset('/images/no-image.jpg') }}"
                    alt="{{ $post->name }}"
                >
            </div>

            <div class="content-mce mb-4">
                @php
                    $doc = new DOMDocument();
                    libxml_use_internal_errors(true);
                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . '<body><div class="generate-index-content mb-4 p-4 bg-gray-100 rounded-md"><div class="font-bold text-xl py-1">Xem nhanh</div></div>' . $post->content . '</body>');
                    libxml_clear_errors();

                    // create document fragment
                    $frag = $doc->createDocumentFragment();
                    // create initial list
                    $frag->appendChild($doc->createElement('ol'));
                    $head = &$frag->firstChild;
                    $xpath = new DOMXPath($doc);
                    $last = 1;

                    // get all H1, H2, …, H6 elements
                    foreach ($xpath->query('//*[self::h2 or self::h3]') as $headline) {
                        // get level of current headline
                        sscanf($headline->tagName, 'h%u', $curr);

                        // move head reference if necessary
                        if ($curr < $last) {
                            // move upwards
                            for ($i=$curr; $i<$last; $i++) {
                                $head = &$head->parentNode->parentNode;
                            }
                        } else if ($curr > $last && $head->lastChild) {
                            // move downwards and create new lists
                            for ($i=$last; $i<$curr; $i++) {
                                $head->lastChild->appendChild($doc->createElement('ul'));
                                $head = &$head->lastChild->lastChild;
                            }
                        }
                        $last = $curr;

                        // add list item
                        $li = $doc->createElement('li');
                        $head->appendChild($li);
                        $a = $doc->createElement('a', preg_replace("/&(?!\S+;)/", "&amp;", $headline->textContent));
                        $head->lastChild->appendChild($a);

                        // build ID
                        $levels = array();
                        $tmp = &$head;
                        // walk subtree up to fragment root node of this subtree
                        while (!is_null($tmp) && $tmp != $frag) {
                            $levels[] = $tmp->childNodes->length;
                            $tmp = &$tmp->parentNode->parentNode;
                        }
                        $id = 'sect'.implode('.', array_reverse($levels));
                        // set destination
                        $a->setAttribute('href', '#'.$id);
                        // add anchor to headline
                        $a = $doc->createElement('a');
                        $a->setAttribute('name', $id);
                        $a->setAttribute('id', $id);
                        $headline->insertBefore($a, $headline->firstChild);
                    }

                    // append fragment to document
                    if (!empty($xpath->query('//*[self::h1 or self::h2 or self::h3]')->count())){
                        $doc->getElementsByTagName('body')->item(0)->firstChild->appendChild($frag);
                    }else{
                        $doc->getElementsByTagName('body')->item(0)->removeChild($doc->getElementsByTagName('body')->item(0)->firstChild);
                    }
                    // echo markup
                    $content = $doc->saveHTML();
                @endphp
                {!! $content !!}
            </div>
            <style>
                .content-mce .generate-index-content a:hover{
                    color: blue;
                }
                .content-mce .generate-index-content ol{
                    list-style-type: none !important;
                    margin-left: 0 !important;
                    padding-left: 0 !important;
                }
            </style>
            <div class="text-right pb-4 border-b border-gray-100">
                <em>Nguồn: {{ $post->auth->name }}</em>
            </div>
            @if(count($post->categories)>0)
                <div class="py-4 border-b border-gray-100">
                    Chuyên mục:
                    @foreach($post->categories as $category)
                        <a href="{!! route(ROUTE_BLOG_POST_CATEGORY_SCREEN_NAME, ['slug' => $category->slug]) !!}">{{ $category->name }}</a><span> , </span>
                    @endforeach
                </div>
            @endif
            <div class="py-4 border-b border-gray-100">
                Tag: Tin tức
            </div>
            <div class="py-4 border-b border-gray-100 flex">
                Chia sẻ: <span class="flex ml-3 border-gray-200">
                            <a class="text-white bg-blue-500 px-4 rounded-sm" href="javascript:void(window.open('https://www.facebook.com/sharer.php?u=' + encodeURIComponent(document.location) + '?t=' + encodeURIComponent(document.title),'_blank'))">
                                Facebook
                            </a>
                            <a class="ml-2 text-white bg-green-500 px-4 rounded-sm" href="javascript:void(window.open('https://twitter.com/share?url=' + encodeURIComponent(document.location) + '&amp;text=' + encodeURIComponent(document.title) + '&amp;via=fabienb&amp;hashtags=koandesign','_blank'))">
                                Twitter
                            </a>
                        </span>
            </div>

            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="VKxCFr5E"></script>
            <div id="fb-root"></div>
            <div
                class="fb-comments"
                data-href="{!! $post->url !!}"
                data-width="100%"
                data-numposts="5"
                style="background: white;display: block;width: 100%"
            >
            </div>

            @if(count($post->categories)>0)
                <div class="py-4 border-t border-gray-100">
                    {{--                    <div class="text-xl mb-2">Tin liên quan</div>--}}
                    <div class="flex flex-wrap -mx-2">
                        @foreach(get_list_posts_category(Arr::get($post->categories->first(), 'id'), 6) as $post)
                            <div class="w-1/2 xl:w-1/3 p-2">
                                <x-theme::card.post
                                    :data="$post"
                                    video="{{ !empty($post->format_type) && $post->format_type === 'video' ? true : false }}"
                                />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        @include(Theme::getThemeNamespace('layouts.sidebar-all'))

    </div>

</x-guest-layout>
