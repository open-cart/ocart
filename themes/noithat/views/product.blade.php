<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div x-data="product()">
        <div class="container-custom">
            <ol class="list-reset py-4 flex text-xs md:text-base text-grey">
                <li class="pr-2"><a href="{!! route('home') !!}" class="no-underline text-blue-600">Home</a></li>
                <li>/</li>
                @if(count($product->categories)>0)
                    <li class="px-2 line-clamp-1"><a href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug' => Arr::get($product->categories->first(), 'slug')]) !!}" class="no-underline text-blue-600">{{ Arr::get($product->categories->first(), 'name') }}</a></li>
                    <li>/</li>
                @endif
                <li class="px-2 line-clamp-1"><span class="no-underline text-gray-500">{{ $product->name }}</span></li>
            </ol>
        </div>
        <section class="section-custom pt-0 product-library text-gray-700 body-font overflow-hidden bg-white">
            <div class="container-custom relative">
                <div class="lg:w-full mx-auto flex flex-wrap">
                    <div class="lg:w-1/2 w-full">
                        <div class="mb-4">
                            <img class="w-full h-full object-cover object-center rounded" x-bind:src="product.images.length ? product.images[index] : '/no-images'" alt="ecommerce">
                        </div>
                        <div class="mt-2">
                            <template x-for="(item, i) in product.images" :key="item">
                                <div x-on:click="index = i" class="inline-block w-12 h-12 mr-1">
                                    <img x-bind:src="item"
                                         alt=""
                                         class="w-full h-full object-cover border border-solid"
                                         :class="index == i && 'border-red-400'"
                                    >
                                </div>
                            </template>
                        </div>

                        {{--                        <div class="owl-carousel owl-theme mt-2 relative">--}}
                        {{--                            <template x-for="(item, i) in images" :key="item">--}}
                        {{--                                <div x-on:click="index = i" class="item">--}}
                        {{--                                    <img x-bind:src="item" alt="" class="w-full h-full object-cover">--}}
                        {{--                                </div>--}}
                        {{--                            </template>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="lg:w-1/2 w-full lg:pl-10 lg:pb-6 mt-6 lg:mt-0">
                        <h1 class="text-gray-900 text-lg lg:text-2xl title-font font-medium mb-2" x-text="product.name">{{ $product->name }}</h1>
                        @if($product->address)
                            <div class="text-sm text-gray-500">
                            <span class="flex items-center">
                                <x-theme::icons.marker/> <span x-text="product.address">{{ $product->address }}</span>
                            </span>
                            </div>
                        @endif
                        <div class="flex items-center mb-4">
                            @if(!empty($product->sku))
                                <span class="text-gray-400 border-r-2 border-gray-200 mr-3 pr-3">
                            Sku: <span x-text="product.sku">{{ $product->sku }}</span>
                        </span>
                            @endif
                            <a href="#comment-list" class="flex items-center">
                                <x-theme::icons.star class="text-yellow-300"/>
                                <x-theme::icons.star class="text-yellow-300"/>
                                <x-theme::icons.star class="text-yellow-300"/>
                                <x-theme::icons.star class="text-yellow-400"/>
                                <x-theme::icons.star class="text-yellow-500"/>
                                <span class="text-gray-500 ml-1">(10 Đánh giá)</span>
                            </a>
                        </div>
                        <div class="mb-4 pt-4 border-t border-gray-200">
                            <template x-if="product.sell_price && product.sell_price > 0">
                                <span class="title-font font-bold text-2xl text-red-600"><span x-text="product.sell_price"></span>đ</span>
                            </template>
                            <template x-if="product.price > product.sell_price">
                                <span class="title-font font-medium text-md text-gray-300 line-through ml-4"><span x-text="product.price"></span>đ</span>
                            </template>
                            <template x-if="!(product.sell_price && product.sell_price > 0) && !(product.price > product.sell_price)">
                                <span class="title-font font-bold text-2xl text-red-600">Liên hệ</span>
                            </template>

                        </div>
                        @if(!empty($product->description))
                            <div class="leading-relaxed text-sm md:text-base pt-4 mb-4 border-t border-gray-200">{!! $product->description !!}</div>
                        @endif
                        @if(is_active_plugin('attribute') && $product->attribute_groups)
                        <!-- Start Attribute -->
                            <template x-if="product?.attribute_groups?.length">
                                <div class="attribute block items-center pt-4 border-t border-gray-200 mt-4">
                                    <template x-for="(item, id) in product.attribute_groups" :key="id">
                                        <div class="flex flex-wrap md:flex-nowrap items-center md:mr-6 mb-3">
                                            <span class="mr-3 w-full md:w-28" x-text="item?.attribute_group?.title"></span>
                                            {{--                                    <template x-if="item?.attribute_group?.slug == 'mau-sac'">--}}
                                            {{--                                        <button class="border-2 border-gray-300 rounded-full w-6 h-6 focus:outline-none"></button>--}}
                                            {{--                                        <button class="border-2 border-gray-300 ml-1 bg-gray-700 rounded-full w-6 h-6 focus:outline-none"></button>--}}
                                            {{--                                        <button class="border-2 border-gray-300 ml-1 bg-blue-600 rounded-full w-6 h-6 focus:outline-none"></button>--}}
                                            {{--                                    </template>--}}
                                            <template x-if="item.attribute">
                                                <div class="relative">
                                                    <x-select x-on:change="changeSelected(item)"
                                                              x-model="item.selected"
                                                              class="rounded appearance-none bg-blue-50 py-2 focus:outline-none text-base pl-3 pr-10">
                                                        <option x-bind:value="[0, item.attribute_group.id].join(',')">Lựa chọn</option>
                                                        <template x-for="(itemAttr, indexAttr) in item.attribute" :key="indexAttr">
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
                            <div class="flex flex-wrap md:flex-nowrap items-center">
                                <span class="mr-3 w-full md:w-28">Số lượng</span>
                                <div class="relative">
                                    <x-input class="rounded appearance-none bg-blue-50 py-2 focus:outline-none text-base px-3 w-20"
                                             type="number"
                                             min="1"
                                             x-model="quantity"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-200 ">
                            <button x-on:click="clickAddToCart(product.id, quantity)"
                                    class="items-center whitespace-nowrap inline-flex w-full text-white bg-blue-600 border-0 py-3 px-6 focus:outline-none hover:bg-red-600 rounded">
                                <x-theme::icons.shopping-cart class="w-8"/>
                                <span class="w-full text-xl">Thêm vào giỏ</span>
                            </button>
                            @if(!empty(get_phone()))
                                <a href="tel:{{ preg_replace( '/[^0-9]/', '', get_phone() )}}"
                                   class="items-center whitespace-nowrap inline-flex w-full text-white bg-green-500 border-0 py-3 px-6 mt-3 focus:outline-none hover:bg-red-600 rounded">
                                    <x-theme::icons.phone class="w-8"/>
                                    <span class="w-full text-xl text-center">{{ get_phone() }}</span>
                                </a>
                            @endif

                            {{--                        <button class="ml-auto rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">--}}
                            {{--                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">--}}
                            {{--                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>--}}
                            {{--                            </svg>--}}
                            {{--                        </button>--}}
                        </div>

                        <div class="pt-4 border-t border-gray-200 flex items-center justify-between">
                            @if(count($product->categories)>0)
                                <h2 class="text-base title-font text-gray-500 line-clamp-1">
                                    @foreach($product->categories as $key=>$item)
                                        <a href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug' => $item->slug]) !!}" class="hover:text-blue-700">{{ $item->name }}</a>

                                        @if(count($product->categories) != $key + 1)
                                            <span>, </span>
                                        @endif
                                    @endforeach
                                </h2>
                            @endif

                            <div class="flex">
                                <a class="ml-2 p-0.5 text-white bg-blue-700 rounded-md hover:bg-blue-900" href="javascript:void(window.open('https://www.facebook.com/sharer.php?u=' + encodeURIComponent(document.location) + '?t=' + encodeURIComponent(document.title),'_blank'))">
                                    <x-theme::icons.facebook/>
                                </a>
                                <a class="ml-2 p-0.5 text-white bg-blue-400 rounded-md hover:bg-blue-700" href="javascript:void(window.open('https://twitter.com/share?url=' + encodeURIComponent(document.location) + '&amp;text=' + encodeURIComponent(document.title) + '&amp;via=fabienb&amp;hashtags=koandesign','_blank'))">
                                    <x-theme::icons.twitter/>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <div class="bg-blue-50">
            <div class="container-custom py-12 justify-center">
                <div x-data="{selected:1}" id="comment-list" class="bg-white rounded-md mb-7">
                    <ul class="shadow-box">

                        <li class="relative">

                            <button type="button" class="w-full px-6 py-4 text-left outline-none focus:outline-none" x-on:click="selected !== 1 ? selected = 1 : selected = null">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold">Chi tiết sản phẩm</span>
                                    <x-theme::icons.chevron-down/>
                                </div>
                            </button>

                            <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                <div class="px-6 pb-4">
                                    {!! $product->content !!}
                                </div>
                            </div>

                        </li>

                    </ul>
                </div>

                <div class="fb-comments mb-7" data-href="{!! route(ROUTE_PRODUCT_SCREEN_NAME, ['slug' => $product->slug]) !!}" data-width="100%" data-numposts="5" style="background: white;display: block;"></div>

                @if(count($product->categories)>0)
                    <div>
                        <div class="text-left outline-none focus:outline-none font-bold mb-2 lg:mb-4">Sản phẩm liên quan</div>
                        <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                            @foreach(get_list_products_relate(Arr::get($product->categories->first(), 'id'), 6) as $item)
                                <div>
                                    <x-theme::card.product :data="$item"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div>
                    @php
                        $products_feature = get_list_products_feature(8);
                    @endphp
                    <div class="text-left outline-none focus:outline-none font-bold my-2 lg:my-4">Sản phẩm bán chạy</div>
                    <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                        @foreach($products_feature as $item)
                            <div>
                                <x-theme::card.product :data="$item"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                margin: 10,
                nav: true,
                items:5,
                dots:false,
            })
        });

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
                    const item = [ ...key, ...[p[i]] ];

                    const keyString = item.join(',');

                    res.push(keyString);
                }
                key = [p.shift()];

                const b = [...p];

                res = res.concat(generateKey(b, [...first, ...key]));
            }
            return res;
        }

        function activeAttr(active_attr = [], attribute_groups = [], product_related = []){
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

        function findProductActive(active_attr = [], attribute_groups = [], product_related = [], product_slug = null){
            if (active_attr?.length == attribute_groups?.length){
                active_attr.sort(function (a, b){
                    return a.attribute_group_id - b.attribute_group_id
                });

                const keyactive = active_attr.map(x => x.id).join(',');

                const product_new = product_related.find(x => x.key.indexOf(keyactive) !== -1)

                return  product_new;
            }
        }

        function postParamAttrs(active_attr){
            const params = active_attr.map((x) => {
                return [x.id, x.attribute_group_id].join(',')
            }).join('-');

            if (params){
                history.pushState({params}, '', `?attrs=${params}`)
            }
        }

        function getParamAttrs(){
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const attrs = urlParams.get('attrs');

            let attrsNew = attrs?.split('-');
            attrsNew = attrsNew?.map((x) => {
                const a = x.split(',');
                const b = { id: Number(a[0]), attribute_group_id: Number(a[1]) }
                return b
            })

            return attrsNew || [];
        }

        function product(){
            let product = @json($product);
            let attributes = {};
            let list_attr = [];

            const attribute_groups = product.attribute_groups;

            const listattr = {};
            let active_attr = [];

            const paramOrigin = getParamAttrs();

            for(const p of product.product_related) {
                if (p.is_default == 1){
                    const active_attr_default = p.items.map(x => x.attribute);
                    if ((paramOrigin?.length != attribute_groups?.length) && (active_attr_default?.length == attribute_groups?.length)){
                        postParamAttrs(active_attr_default);
                    }
                }
                for(const item of p.items) {
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
                if(attr_selected){
                    item.selected = [attr_selected?.id, attr_selected?.attribute_group_id].join(',');
                }
            }

            const product_related = product.product_related.map(x => {
                x.key = Array.from(new Set(generateKey([...x.items.map(x => x.attribute_id)], [])))
                return x;
            });

            activeAttr(active_attr, attribute_groups, product_related);

            const product_active = findProductActive(active_attr, attribute_groups, product_related, product.slug);
            if (product_active){
                product.price = product_active.product.price;
                product.sale_price = product_active.product.sale_price;
                product.sell_price = product_active.product.sell_price;
                product.sku = product_active.product.sku;
                product.images = product_active.product.images;
            }

            return {
                quantity: 1,
                index: 0,
                product: product,
                product_active: product_active,
                product_related: product_related,
                active: active_attr.map(x => ({id:x.id, attribute_group_id: x.attribute_group_id})),
                changeSelected(item) {
                    const a = item.selected.split(',');

                    const b = { id: Number(a[0]), attribute_group_id: Number(a[1]) }

                    at = this.active.find(x=>x.attribute_group_id == b.attribute_group_id);

                    if (at){
                        at.id = b.id;
                    }else {
                        this.active.push(b)
                    }

                    if (!b.id) {
                        this.active = this.active.filter(x => x != at);
                    }

                    if (this.active?.length == this.product?.attribute_groups?.length){
                        postParamAttrs(this.active);
                        this.active = getParamAttrs();
                    }

                    const active_attr = this.active;

                    activeAttr(active_attr, this.product.attribute_groups, this.product_related);

                    this.product_active = findProductActive(active_attr, this.product.attribute_groups, this.product_related, this.product.slug);
                    if (this.product_active){
                        this.product.price = this.product_active.product.price;
                        this.product.sale_price = this.product_active.product.sale_price;
                        this.product.sell_price = this.product_active.product.sell_price;
                        this.product.sku = this.product_active.product.sku;
                        this.product.images = this.product_active.product.images;
                    }

                    // history.pushState({}, '', 'san-pham-11?')
                },
                clickAddToCart(product_id, quantity){
                    if (this.active.length < product?.attribute_groups?.length){
                        console.log('Vui lòng chọn thuộc tính', product_id, quantity);
                        return;
                    }
                    console.log('click', product_id, quantity);
                }
            }
        }

    </script>
    <style>
        .product-library .owl-item:first-child{
            display: none !important;
        }
        .owl-carousel:not(.owl-loaded){
            opacity: 0;
            visibility:hidden;
        }
        .owl-carousel .owl-dots {
            position: absolute;
            bottom: 0px;
            width: 100%;
        }
        .owl-nav{
            font-size: 3rem;
        }
        .owl-prev:focus,
        .owl-next:focus{
            outline: none;
        }
        .owl-prev{
            position: absolute;
            top: calc(50% - 5px);
            left: 5px;
            transform: translateY(-50%);

        }
        .owl-next{
            position: absolute;
            top: calc(50% - 5px);
            right: 5px;
            transform: translateY(-50%);
        }
        .owl-prev span,
        .owl-next span{
            color: grey;
        }
        .owl-prev span:hover,
        .owl-next span:hover{
            color: black;
        }

        .owl-carousel button:hover, .owl-carousel button:focus, .owl-carousel button:focus-visible{
            outline: none;
            background: none !important;
        }
    </style>
</x-guest-layout>

