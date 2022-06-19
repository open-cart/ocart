<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div x-data="product()">
        <div class="container-custom">
            <ol class="list-reset py-4 flex text-xs md:text-base text-grey">
                <li class="pr-2"><a href="{!! route('home') !!}" class="no-underline text-blue-600">Home</a></li>
                <li>/</li>
                @if(count($product->categories)>0)
                    <li class="px-2 line-clamp-1"><a
                            href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug' => Arr::get($product->categories->first(), 'slug')]) !!}"
                            class="no-underline text-blue-600">{{ Arr::get($product->categories->first(), 'name') }}</a>
                    </li>
                    <li>/</li>
                @endif
                <li class="px-2 line-clamp-1"><span class="no-underline text-gray-500">{{ $product->name }}</span></li>
            </ol>
        </div>
        <section class="section-custom pt-0 product-library text-gray-700 body-font overflow-hidden bg-white">
            <div class="container-custom relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <div class="mb-4">
                            <img
                                id="imageMainProduct"
                                class="w-full h-full object-cover object-center rounded lozad"
                                src="{{ asset('/images/no-image.jpg') }}"
                                x-bind:src="product.images.length ? product.images[index]  + `?w=850&h=850` : '/no-images'"
                                alt="ecommerce image">
                        </div>

                        <div id="imagesProduct" class="mt-2"></div>
                        <template id="imagesProductHtml">
                            <div x-on:click="changeIndex($event)"
                                 class="imagesProductHtmlItem inline-block w-12 h-12 mr-1">
                                <img
                                    class="w-full h-full object-cover border border-solid cursor-pointer"
                                    alt="library images"
                                >
                            </div>
                        </template>
                    </div>
                    <div>
                        <h1 class="text-gray-900 text-lg lg:text-2xl title-font font-medium mb-2"
                            x-text="product.name">{{ $product->name }}</h1>
                        @if($product->address)
                            <div class="text-sm text-gray-500">
                            <span class="flex items-center">
                                <x-theme::icons.marker/> <span x-text="product.address">{{ $product->address }}</span>
                            </span>
                            </div>
                        @endif
                        <div class="flex items-center mb-4">
                            @if(!empty($product->sku))
                                <span class="text-gray-400 pr-3 flex-1 line-clamp-1">
                            Sku: <span x-text="product.sku">{{ $product->sku }}</span>
                            </span>
                            @endif
                            @if(is_active_plugin('ec_review'))
                                <a
                                    href="#reviews-list"
                                    class="flex items-center"
                                >
                                    @php
                                        $avg = get_average_star_of_product($product->id);
                                        $count_reviews = get_count_reviewed_of_product($product->id);
                                    @endphp
                                    @for($i=0; $i < 5; $i++)
                                        <x-theme::icons.star :active="$i < $avg"/>
                                    @endfor
                                    <span class="text-gray-500 ml-1">({{ $count_reviews }} Đánh giá)</span>
                                </a>
                            @endif
                        </div>
                        <div class="mb-4 pt-4 border-t border-gray-200">
                            <template x-if="product.sell_price && product.sell_price > 0">
                                <span
                                    class="title-font font-bold text-2xl text-red-600"
                                >
                                    <span x-text="product.sell_price.toLocaleString()"></span>
                                    <span class="font-semibold underline">đ</span>
                                </span>
                            </template>
                            <template x-if="product.price > product.sell_price">
                                <span class="title-font font-medium text-md text-gray-500 line-through ml-4">
                                    <span x-text="product.price.toLocaleString()"></span>
                                    <span class="font-semibold">đ</span>
                                </span>
                            </template>
                            <template
                                x-if="!(product.sell_price && product.sell_price > 0) && !(product.price > product.sell_price)">
                                <span class="title-font font-bold text-2xl text-red-600">Liên hệ</span>
                            </template>

                        </div>
                        @if(!empty($product->description))
                            <div
                                class="leading-relaxed text-sm md:text-base pt-4 mb-4 border-t border-gray-200">{!! $product->description !!}</div>
                        @endif
                        @if(is_active_plugin('attribute') && $product->attribute_groups)
                        <!-- Start Attribute -->
                            <template x-if="product?.attribute_groups?.length">
                                <div class="attribute block items-center pt-4 border-t border-gray-200 mt-4">
                                    <template x-for="(item, id) in product.attribute_groups" :key="id">
                                        <div class="flex flex-wrap md:flex-nowrap items-center md:mr-6 mb-3">
                                            <span class="mr-3 w-full md:w-28"
                                                  x-text="item?.attribute_group?.title"></span>
                                            <template x-if="item.attribute">
                                                <div class="relative">
                                                    <x-select x-on:change="changeSelected(item)"
                                                              x-model="item.selected"
                                                              class="rounded appearance-none bg-blue-50 py-2 focus:outline-none text-base pl-3 pr-10">
                                                        <option
                                                            x-bind:value="[0, item.attribute_group.id].join(',')">
                                                            Lựa chọn
                                                        </option>
                                                        <template x-for="(itemAttr, indexAttr) in item.attribute"
                                                                  :key="indexAttr">
                                                            <option x-text="itemAttr.title" :key="itemAttr.id"
                                                                    x-bind:value="[itemAttr.id, itemAttr.attribute_group_id].join(',')"
                                                                    x-bind:selected="[itemAttr.id, itemAttr.attribute_group_id].join(',') == item.selected"
                                                                    x-bind:disabled="!itemAttr.active">
                                                            </option>
                                                        </template>
                                                    </x-select>
                                                    <span
                                                        class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                     stroke-linejoin="round" stroke-width="2" class="w-4 h-4"
                                                     viewBox="0 0 24 24">
                                                  <path d="M6 9l6 6 6-6"></path>
                                                </svg>
                                            </span>
                                                </div>

                                            </template>
                                        </div>

                                    </template>
                                </div>

                            </template>
                            <!-- End Attribute -->
                        @endif

                        <div class="items-center pt-4 border-t border-gray-200 mb-4">
                            <div class="flex flex-wrap md:flex-nowrap items-center justify-between">
                                <div class="relative mr-2">
                                    <span class="mr-2">Số lượng:</span>

                                    <x-input
                                        class="rounded appearance-none bg-blue-50 py-2 border-none focus:outline-none text-base px-3 w-20"
                                        type="number"
                                        min="1"
                                        x-model="quantity"
                                    />
                                </div>
                                <button
                                    x-on:click="clickAddToCart()"
                                    class="items-center whitespace-nowrap inline-flex bg-blue-50 border-0 py-2 px-6 focus:outline-none rounded"
                                >
                                    <x-theme::icons.plus-circle class="w-6"/>
                                    <span class="hidden md:inline-block w-full">Thêm vào giỏ</span>
                                    <span class="inline-block md:hidden w-full">Giỏ</span>
                                </button>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-200 ">
                            <button x-on:click="clickAddToCart({{true}})"
                                    class="items-center whitespace-nowrap inline-flex w-full text-white bg-red-600 border-0 py-3 px-6 focus:outline-none rounded">
                                <x-theme::icons.shopping-cart class="w-8"/>
                                <div class="w-full">
                                    <span class="uppercase">Đặt mua ngay</span>
                                </div>
                            </button>

                            @if(!empty(theme_options()->getOption('phone', null)))
                                <a href="tel:{{ preg_replace( '/[^0-9]/', '', theme_options()->getOption('phone', null) )}}"
                                   class="items-center whitespace-nowrap inline-flex w-full text-white bg-green-500 border-0 py-3 px-6 mt-3 focus:outline-none rounded">
                                    <x-theme::icons.phone class="w-8"/>
                                    <span
                                        class="w-full text-xl text-center">{{ theme_options()->getOption('phone', null) }}</span>
                                </a>
                            @endif

                            {{--                        <button class="ml-auto rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">--}}
                            {{--                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">--}}
                            {{--                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>--}}
                            {{--                            </svg>--}}
                            {{--                        </button>--}}
                        </div>

                        <div class="pt-4 mb-3 border-t border-gray-200 flex items-center justify-between">
                            @if(count($product->categories)>0)
                                <h2 class="text-base title-font line-clamp-1">
                                    Danh mục:
                                    @foreach($product->categories as $key=>$item)
                                        <a
                                            href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug' => $item->slug]) !!}"
                                            class="text-gray-500 hover:text-blue-700">
                                            {{ $item->name }}
                                        </a>

                                        @if(count($product->categories) != $key + 1)
                                            <span>, </span>
                                        @endif
                                    @endforeach
                                </h2>
                            @endif

                            <div class="flex">
                                <a class="ml-2 p-0.5 text-white bg-blue-700 rounded-md hover:bg-blue-900"
                                   href="javascript:void(window.open('https://www.facebook.com/sharer.php?u=' + encodeURIComponent(document.location) + '?t=' + encodeURIComponent(document.title),'_blank'))">
                                    <x-theme::icons.facebook/>
                                </a>
                                <a class="ml-2 p-0.5 text-white bg-blue-400 rounded-md hover:bg-blue-700"
                                   href="javascript:void(window.open('https://twitter.com/share?url=' + encodeURIComponent(document.location) + '&amp;text=' + encodeURIComponent(document.title) + '&amp;via=fabienb&amp;hashtags=koandesign','_blank'))">
                                    <x-theme::icons.twitter/>
                                </a>
                            </div>
                        </div>
                        @if(count($product->tags) > 0)
                            <figure>
                                <figcaption class="inline-block">Tags:</figcaption>
                                @foreach($product->tags as $key => $item)
                                    <a
                                        href="{{ $item->url }}"
                                        class="text-xs inline-block py-0.5 px-2 mb-1 mr-1 border border-gray-500 rounded-2xl hover:text-blue-700 hover:border-blue-700"
                                    >
                                        {{ $item->name }}
                                    </a>
                                @endforeach

                            </figure>
                        @endif

                    </div>
                </div>
            </div>
        </section>

        <div class="bg-blue-50">
            <div class="container-custom py-12 justify-center">
                <div x-data="{selected:1}" id="comment-list" class="bg-white rounded-md mb-7">
                    <ul class="shadow-box">

                        <li class="relative">

                            <button type="button" class="w-full px-6 py-4 text-left outline-none focus:outline-none"
                                    x-on:click="selected !== 1 ? selected = 1 : selected = null">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold">Chi tiết sản phẩm</span>
                                    <x-theme::icons.chevron-down class="h-6 w-6 p-1 rounded-full font-bold bg-blue-50"/>
                                </div>
                            </button>

                            <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                                 x-ref="container1"
                                 x-bind:style="selected == 1 ? 'max-height: 6000px;overflow-y: auto;' : ''">
                                <div class="content-mce px-6 pb-4">
                                    {!! $product->content !!}
                                </div>
                                <style>
                                    .content-mce h1{
                                        font-size: 2.2rem;
                                        line-height: 3rem;
                                        margin: 25px 0 15px;
                                    }
                                    .content-mce h2{
                                        font-size: 1.8rem;
                                        line-height: 2.2rem;
                                        margin: 20px 0 10px;
                                    }
                                    .content-mce h3{
                                        font-size: 1.4rem;
                                        line-height: 2rem;
                                        margin: 10px 0 5px;
                                    }
                                    .content-mce h4, .content-mce h5{
                                        font-size: 1.2rem;
                                        line-height: 1.5rem;
                                        margin: 10px 0 5px;
                                    }
                                    .content-mce ul{
                                        list-style-type: disc !important;
                                    }
                                    .content-mce ol{
                                        list-style-type: decimal !important;
                                    }
                                </style>
                            </div>

                        </li>

                    </ul>
                </div>

                @if(is_active_plugin('ec_review'))
                    <div x-data="{selected:1}" id="reviews-list" class="bg-white rounded-md mb-7">
                        <ul class="shadow-box">

                            <li class="relative">

                                <button type="button"
                                        class="w-full px-6 py-4 text-left outline-none focus:outline-none">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold">Khách hàng chấm điểm, đánh giá, nhận xét</span>
                                    </div>
                                </button>

                                @php
                                    $reviews = get_list_reviews_product($product->id, 10);
                                @endphp

                                <div
                                    x-data="{ star: 5, comment: '' }"
                                    class="relative overflow-hidden transition-all duration-700 pb-4"
                                    x-ref="container1"
                                >
                                    <div class="flex px-6 pb-4 nd">
                                        <span class="float-left">Chọn đánh giá của bạn</span>
                                        <div class="flex items-center float-left ml-4">
                                            <x-theme::icons.star
                                                x-on:click="star = 1"
                                                x-bind:class="star >= 1 && 'text-yellow-300'"
                                            />
                                            <x-theme::icons.star
                                                x-on:click="star = 2"
                                                x-bind:class="star >= 2 && 'text-yellow-300'"
                                            />
                                            <x-theme::icons.star
                                                x-on:click="star = 3"
                                                x-bind:class="star >= 3 && 'text-yellow-300'"
                                            />
                                            <x-theme::icons.star
                                                x-on:click="star = 4"
                                                x-bind:class="star >= 4 && 'text-yellow-400'"
                                            />
                                            <x-theme::icons.star
                                                x-on:click="star = 5"
                                                x-bind:class="star >= 5 && 'text-yellow-500'"
                                            />
                                            <span
                                                class="ml-2 bg-green-500 text-white text-sm px-2 relative rounded-sm"
                                                id="star-tip"
                                            >Rất hài lòng</span>
                                            <style>
                                                #star-tip::after {
                                                    right: 100%;
                                                    top: 50%;
                                                    border: solid transparent;
                                                    content: " ";
                                                    height: 0;
                                                    width: 0;
                                                    position: absolute;
                                                    pointer-events: none;
                                                    border-color: rgba(82, 184, 88, 0);
                                                    border-right-color: #52b858;
                                                    border-width: 6px;
                                                    margin-top: -6px;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                    <div class="px-6 pb-4">
                                    <textarea
                                        x-model="comment"
                                        placeholder="Nhập đánh giá về sản phẩm"
                                        class="p-3 bg-indigo-50 w-full rounded-md outline-none"
                                    ></textarea>
                                        @if(Auth::user())
                                            <button x-on:click="postReviews(@json($product->id), star, comment)"
                                                    class="block text-white bg-green-500 border-0 py-4 px-6 mt-2 focus:outline-none hover:bg-green-700 rounded">
                                                Gửi đánh giá
                                            </button>
                                        @else
                                            <a
                                                href="javascript:void(0)"
                                                rel="nofollow"
                                                data-toggle="modal"
                                                data-target="#form-login-modal"
                                                class="inline-block text-white bg-green-500 border-0 py-4 px-6 mt-2 focus:outline-none hover:bg-green-700 rounded"
                                            >
                                                Gửi đánh giá
                                            </a>
                                        @endif

                                    </div>
                                    <div class="px-6 pb-4">
                                        <div class="flex items-center justify-between py-4 my-4 border-t border-b">
                                            <span>Nhận xét về sản phẩm ({{ $count_reviews }} đánh giá)</span>
                                        </div>
                                        <div class="pt-4">
                                            <ul>
                                                @foreach($reviews as $item)
                                                    <li class="mb-5 border-b border-dotted">
                                                        <div class="pb-6">
                                                            <div class="float-left w-16">
                                                                <div
                                                                    class="w-12 h-12 rounded-full flex items-center justify-center bg-gray-100">{{ $item->customer->name[0] }}</div>
                                                            </div>
                                                            <div class="flex flex-wrap">
                                                                <div class="comment-meta w-full">
                                                                    <div class="float-left">
                                                                        <div class="flex items-center">
                                                                            @for($i=0; $i < 5; $i++)
                                                                                <x-theme::icons.star
                                                                                    :active="$i < $item->star"/>
                                                                            @endfor
                                                                        </div>
                                                                        <h4 class="mt-1 text-sm">{{ $item->customer->name }}</h4>
                                                                    </div>
                                                                    <div
                                                                        class="mt-1 text-sm text-green-500 float-right">
                                                                        {{ date_format($item->created_at, "d/m/Y") }}
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2 font-bold text-gray-500">
                                                                    <p>{{ $item->comment }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if(method_exists($reviews, 'links'))
                                                <div>{!! $reviews->links() !!}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                            </li>

                        </ul>
                    </div>
                @endif

                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="VKxCFr5E"></script>
                <div id="fb-root"></div>
                <div
                    class="fb-comments px-3.5 mb-7"
                    data-href="{!! $product->url !!}"
                    data-width="100%"
                    data-numposts="5"
                    style="background: white;display: block;width: 100%"
                >
                </div>

                @if(count($product->categories)>0)
                    @php
                        $products_relate = get_list_products_relate(Arr::get($product->categories->first(), 'id'), 8);
                    @endphp
                    @if(count($products_relate)>1)
                        <div class="mb-7">
                            <div class="text-left outline-none focus:outline-none font-bold mb-2 lg:mb-4">
                                Sản phẩm liên quan
                            </div>
                            <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                                @foreach($products_relate as $item)
                                    <div>
                                        <x-theme::card.product :data="$item"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif

                <div>
                    @php
                        $products_feature = get_list_products_feature(8);
                    @endphp
                    @if(count($products_feature)>1)
                        <div class="text-left outline-none focus:outline-none font-bold my-2 lg:my-4">
                            Sản phẩm bán chạy
                        </div>
                        <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                            @foreach($products_feature as $item)
                                <div>
                                    <x-theme::card.product :data="$item"/>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>

    <script>
        function groupBy(objectArray, property) {
            return objectArray.reduce(function (acc, obj) {
                let key = obj[property]
                if (!acc[key]) {
                    acc[key] = []
                }
                acc[key].push(obj)
                return acc
            }, {})
        }

        function generateKey(p, first = []) {
            let res = [];
            let key = first;

            while (p.length) {
                for (let i = 0; i < p.length; i++) {
                    const item = [...key, ...[p[i]]];

                    const keyString = item.join(',');

                    res.push(keyString);
                }
                key = [p.shift()];

                const b = [...p];

                res = res.concat(generateKey(b, [...first, ...key]));
            }
            return res;
        }

        function activeAttr(active_attr = [], attribute_groups = [], product_related = []) {
            for (let item of attribute_groups) {
                for (const att of item.attribute) {
                    att.active = true;
                }
            }

            for (const active of active_attr) {
                for (const group of attribute_groups) {
                    if (group.attribute_group_id == active.attribute_group_id) {
                        continue;
                    }

                    const actives = [];

                    for (let item of product_related) {
                        const hasAttr = item.items.findIndex(x => {
                            return x.attribute.id == active.id && x.attribute.attribute_group_id == active.attribute_group_id;
                        });

                        if (hasAttr !== -1) {
                            const attr = item.items.find(x => x.attribute.attribute_group_id == group.attribute_group_id);

                            const at = group.attribute.find(x => x.id == attr.attribute.id);
                            actives.push(at);

                        }
                    }
                    for (const at of group.attribute) {
                        if (actives.indexOf(at) == -1) {
                            at.active = false;
                        }
                    }
                }
            }
        }

        function findProductActive(active_attr = [], attribute_groups = [], product_related = [], product_slug = null) {
            if (active_attr?.length == attribute_groups?.length) {
                active_attr.sort(function (a, b) {
                    return a.attribute_group_id - b.attribute_group_id
                });

                const keyactive = active_attr.map(x => x.id).join(',');

                const product_new = product_related.find(x => x.key.indexOf(keyactive) !== -1)

                return product_new;
            }
        }

        function postParamAttrs(active_attr) {
            const params = active_attr.map((x) => {
                return [x.id, x.attribute_group_id].join(',')
            }).join('-');

            if (params) {
                history.pushState({params}, '', `?attrs=${params}`)
            }
        }

        function getParamAttrs() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const attrs = urlParams.get('attrs');

            let attrsNew = attrs?.split('-');
            attrsNew = attrsNew?.map((x) => {
                const a = x.split(',');
                const b = {id: Number(a[0]), attribute_group_id: Number(a[1])}
                return b
            })

            return attrsNew || [];
        }

        function product() {
            let product = @json($product);
            let attributes = {};
            let list_attr = [];
            let _index = 0;

            const attribute_groups = product.attribute_groups;

            const listattr = {};
            let active_attr = [];

            const paramOrigin = getParamAttrs();

            for (const p of product.product_related) {
                if (p.is_default == 1) {
                    const active_attr_default = p.items.map(x => x.attribute);
                    if ((paramOrigin?.length != attribute_groups?.length) && (active_attr_default?.length == attribute_groups?.length)) {
                        postParamAttrs(active_attr_default);
                    }
                }
                for (const item of p.items) {
                    const group_id = item?.attribute?.attribute_group_id || '---';
                    if (!listattr[group_id]) {
                        listattr[group_id] = [];
                    }

                    if (listattr[group_id].findIndex(x => x.id == item.attribute.id) == -1) {
                        listattr[group_id].push(item.attribute);
                    }
                }
            }

            active_attr = getParamAttrs();

            for (const item of attribute_groups) {
                item.attribute = listattr[item.attribute_group_id];
                const attr_selected = active_attr?.find(x => x.attribute_group_id == item.attribute_group_id)
                if (attr_selected) {
                    item.selected = [attr_selected?.id, attr_selected?.attribute_group_id].join(',');
                }
            }

            const product_related = product.product_related.map(x => {
                x.key = Array.from(new Set(generateKey([...x.items.map(x => x.attribute_id)], [])))
                return x;
            });

            activeAttr(active_attr, attribute_groups, product_related);

            function addValueImagesProduct(res) {
                if (res && res.length) {
                    var ImageMain = document.querySelector('#imageMainProduct');
                    $("#imagesProduct").empty();

                    for (let i = 0; i < res.length; i++) {
                        if ('content' in document.createElement('template')) {
                            var tbody = document.querySelector("#imagesProduct");
                            var template = $($('#imagesProductHtml').html());
                            var clone = template.clone();

                            const img = clone.find('img')
                            if(i === 0){
                                img.addClass('border-red-400');
                            }
                            img.data('index', i)
                            img.attr('src', res[i] + `?w=150&h=150`)

                            tbody.appendChild(clone[0]);
                        }
                    }
                }
            }

            const product_active = findProductActive(active_attr, attribute_groups, product_related, product.slug);
            if (product_active) {
                product.id = product_active.product.id;
                product.price = product_active.product.price;
                product.sale_price = product_active.product.sale_price;
                product.sell_price = product_active.product.sell_price;
                product.sku = product_active.product.sku;
                product.images = product_active.product.images;
            }
            addValueImagesProduct(product.images);

            return {
                quantity: 1,
                index: _index,
                product: product,
                product_active: product_active,
                product_related: product_related,
                active: active_attr,
                changeSelected(item) {
                    const a = item.selected.split(',');

                    const b = {id: Number(a[0]), attribute_group_id: Number(a[1])}

                    at = this.active.find(x => x.attribute_group_id == b.attribute_group_id);

                    if (at) {
                        at.id = b.id;
                    } else {
                        this.active.push(b)
                    }

                    if (!b.id) {
                        this.active = this.active.filter(x => x != at);
                    }

                    if (this.active?.length == this.product?.attribute_groups?.length) {
                        postParamAttrs(this.active);
                        this.active = getParamAttrs();
                    }

                    const active_attr = this.active;

                    activeAttr(active_attr, this.product.attribute_groups, this.product_related);

                    this.product_active = findProductActive(active_attr, this.product.attribute_groups, this.product_related, this.product.slug);
                    if (this.product_active) {
                        this.index = 0;
                        this.product.id = this.product_active.product.id;
                        this.product.price = this.product_active.product.price;
                        this.product.sale_price = this.product_active.product.sale_price;
                        this.product.sell_price = this.product_active.product.sell_price;
                        this.product.sku = this.product_active.product.sku;
                        this.product.images = this.product_active.product.images;
                        if (this.product.images.length > 0){
                            addValueImagesProduct(this.product.images);
                        }

                    }
                },
                clickAddToCart(buynow = false) {
                    if (this.product?.attribute_groups?.length && this.active.length < this.product?.attribute_groups?.length) {
                        toast.error('Vui lòng chọn thuộc tính');
                        return;
                    }

                    const product_attrs = this.product?.product_related?.find(x => x.product_id == this.product.id);
                    const optionAttrs = product_attrs?.items || [];

                    for (const item of optionAttrs) {
                        const group_id = item?.attribute?.attribute_group_id || '---';
                        const attrsNew = this.product?.attribute_groups?.find(x => x.attribute_group_id == group_id);
                        item.attribute_group = attrsNew?.attribute_group;
                    }
                    const slug = this.product.slug + window.location.search;

                    addToCart(this.product.id, slug, this.quantity, optionAttrs, buynow);
                },
                changeIndex(e) {
                    this.index = $(e.target).data('index');
                    $('.imagesProductHtmlItem').find('img').removeClass('border-red-400');
                    $(e.target).addClass('border-red-400');
                }
            }
        }

        @if(is_active_plugin('ec_review'))
        function postReviews(product_id, star, comment) {
            if (!comment) {
                toast.error('Vui lòng nhập đánh giá của bạn!')
                return;
            }
            axios.post('{{route(PUBLIC_ROUTE_REVIEWS_CREATE)}}', {
                product_id: product_id,
                star: star,
                comment: comment,
                status: '{{ \Ocart\Core\Enums\BaseStatusEnum::PUBLISHED }}',
            }).then((res) => {
                toast.success(res.message);
            }).catch(e => {
                toast.error(e.message)
            });
        }
        @endif

    </script>
    <style>
        .product-library .owl-item:first-child {
            display: none !important;
        }

        .owl-carousel:not(.owl-loaded) {
            opacity: 0;
            visibility: hidden;
        }

        .owl-carousel .owl-dots {
            position: absolute;
            bottom: 0px;
            width: 100%;
        }

        .owl-nav {
            font-size: 3rem;
        }

        .owl-prev:focus,
        .owl-next:focus {
            outline: none;
        }

        .owl-prev {
            position: absolute;
            top: calc(50% - 5px);
            left: 5px;
            transform: translateY(-50%);

        }

        .owl-next {
            position: absolute;
            top: calc(50% - 5px);
            right: 5px;
            transform: translateY(-50%);
        }

        .owl-prev span,
        .owl-next span {
            color: grey;
        }

        .owl-prev span:hover,
        .owl-next span:hover {
            color: black;
        }

        .owl-carousel button:hover, .owl-carousel button:focus, .owl-carousel button:focus-visible {
            outline: none;
            background: none !important;
        }
    </style>
</x-guest-layout>
