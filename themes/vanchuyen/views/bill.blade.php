<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
<div id="billSearch" x-data="bill()">
    <div
        style="background-image:url('https://viettelpost.com.vn/wp-content/uploads/2021/02/1920px-Hong_Kong_Skyline_Panorama_-_Dec_200811.jpg');background-size: cover;"
    >
        <div class="text-center py-8 lg:py-20 text-white">
            <p class="text-lg lg:text-4xl uppercase font-bold mb-2 lg:mb-4">TRA CỨU HÀNH TRÌNH ĐƠN HÀNG</p>
            <p class="lg:text-3xl">“Mạng chuyển phát nhanh rộng khắp"</p>
        </div>
    </div>
    <div class="container-custom py-4 lg:py-8">
       <div class="grid grid-cols-1 lg:grid-cols-2 mb-6 lg:mb-12 items-center lg:gap-12">
           <form
               action="{{ route('bill') }}"
               method="GET"
           >
               <h2 class="text-lg lg:text-2xl font-bold mb-2">Mã đơn hàng</h2>
               <div class="mb-3 lg:mb-6">
                   <input
                       id="input-search-bill"
                       type="text" placeholder="VD: #123456"
                       x-bind:value="name"
                       class="w-full py-2 px-4 border rounded-md border-gray-300"
                       autocomplete="off"
                       name="query"
                       required
                   >
               </div>
               <input type="hidden" name="submit" value="search"/>

               <button type="submit" class="bg-red-500 text-white text-lg lg:text-xl font-bold py-2 px-8">
                   Tra cứu
               </button>
           </form>
           <div class="hidden">
               <img src="https://viettelpost.vn/viettelpost-iframe/assets/images/tracking-img.svg" alt="">
           </div>
       </div>
        @if($orders && $orders->count() > 0)
            @foreach($orders as $order)
                <div class="bg-gray-100 p-4 lg:p-8 mb-4">
                    <div class="text-lg lg:text-2xl uppercase mb-3 lg:mb-6">Thông tin đơn hàng: {{ $order->code }}</div>
                    <div>
                        <div class="text-red-500 lg:text-xl font-bold mb-2 lg:mb-3">
                            @if($order->status == 'pending')
                                Chưa xử lý
                            @elseif($order->status == 'processing')
                                Đang xử lý
                            @elseif($order->status == 'delivering')
                                Đang vận chuyển
                            @elseif($order->status == 'delivered')
                                Đã giao hàng
                            @elseif($order->status == 'completed')
                                Đã hoàn tất
                            @elseif($order->status == 'canceled')
                                Đã hủy
                            @endif
                        </div>
                        <div>{!! $order->description !!}</div>
                    </div>
                </div>
            @endforeach
        @else
            <div x-show="name" class="bg-gray-100 p-4 lg:p-8">
                Đơn hàng không tồn tại. Vui lòng kiểm tra lại hoặc liên hệ với chúng tôi để được trợ giúp.
            </div>
        @endif
        <div class="py-4 lg:py-8">
            <img src="https://viettelpost.vn/viettelpost-iframe/assets/images/tracking-img.svg" alt="" class="mx-auto">
        </div>
    </div>
</div>
<script>
    function bill() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const _name = urlParams.get('query');

        return {
            name: _name
        };
    }

    $(function () {
        const filterForm = $('#billSearch');

        const searchFn = function (event) {
            event.preventDefault();
            function isEmpty( el ){
                return !$.trim(el.html())
            }
            if (isEmpty($('#layout-content-main'))) {
                $.pjax.submit(event, '#body-content');
            }else {
                $.pjax.submit(event, '#layout-content-main');
            }
        }

        filterForm.on('click', 'button', () => {
            let inputSearch = filterForm.find('#input-search-bill')[0].value
            if (inputSearch != ''){
                filterForm.find('form').submit();
            }
        });

        filterForm.on('submit', 'form', searchFn)
    })

</script>

</x-guest-layout>
