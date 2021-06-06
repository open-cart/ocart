@php
    $partner = get_partner(6);
@endphp
@if(!empty($partner))
<section class="section-custom antialiased font-sans">
    <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
        <h2 class="text-xl md:text-2xl font-bold">Đối tác</h2>
        <p class="text-gray-600">
            Là một công ty hàng đầu chúng tôi hợp tác các cơ quan tiêu chuẩn trên thế giới để giúp phát triển những cam kết và chuẩn mực thực hành.</p>
    </div>

    <div class="container-custom">
        <div class="flex flex-wrap">
            @foreach($partner as $item)
                <div class="w-1/2 sm:w-1/2 xl:w-1/3 p-0.5">
                    <div class="bg-gray-100 p-2 sm:py-4 sm:px-0">
                        <img class="w-auto max-h-12 mx-auto" src="{{ $item->img }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
