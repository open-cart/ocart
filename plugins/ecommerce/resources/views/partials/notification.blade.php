<div class="flex items-center">
    <x-dropdown align="right" width="60">
        <x-slot name="trigger">
            <x-link href="javascript:void(0)" class="cursor-pointer px-3">
                <span class="relative inline-block">
                <svg class="w-5 h-5 fill-current dark:text-white" height="512pt" viewBox="0 -31 512.00033 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="m166 300.003906h271.003906c6.710938 0 12.597656-4.4375 14.414063-10.882812l60.003906-210.003906c1.289063-4.527344.40625-9.390626-2.433594-13.152344-2.84375-3.75-7.265625-5.964844-11.984375-5.964844h-365.632812l-10.722656-48.25c-1.523438-6.871094-7.617188-11.75-14.648438-11.75h-91c-8.289062 0-15 6.710938-15 15 0 8.292969 6.710938 15 15 15h78.960938l54.167968 243.75c-15.9375 6.929688-27.128906 22.792969-27.128906 41.253906 0 24.8125 20.1875 45 45 45h271.003906c8.292969 0 15-6.707031 15-15 0-8.289062-6.707031-15-15-15h-271.003906c-8.261719 0-15-6.722656-15-15s6.738281-15 15-15zm0 0"/><path d="m151 405.003906c0 24.816406 20.1875 45 45.003906 45 24.8125 0 45-20.183594 45-45 0-24.8125-20.1875-45-45-45-24.816406 0-45.003906 20.1875-45.003906 45zm0 0"/><path d="m362.003906 405.003906c0 24.816406 20.1875 45 45 45 24.816406 0 45-20.183594 45-45 0-24.8125-20.183594-45-45-45-24.8125 0-45 20.1875-45 45zm0 0"/></svg>
                  <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $orders->count() }}</span>
                </span>
            </x-link>
        </x-slot>
        <x-slot name="content">
            <ul class="text-sm -mt-1">
                <li class="flex justify-between px-3 py-5 bg-gray-100">
                    <h3 class="font-bold">{!! trans('plugins/ecommerce::orders.new_order_notice', ['count' => $orders->count()]) !!}</h3>
                    <a class="text-blue-500 hover:text-blue-600" href="{{ route('ecommerce.orders.index') }}">{{ trans('plugins/ecommerce::orders.view_all') }}</a>
                </li>
                <li>
                    <ul class="overflow-auto" style="max-height: 440px; {{ count($orders) * 72 }}px;" data-handle-color="#637283">
                        @foreach($orders as $order)
                            <li class="border-t">
                                <a class="flex space-x-3 py-4 px-3 hover:bg-gray-50" href="{{ route('ecommerce.orders.update', $order->id) }}">
                                    <span class="flex-none items-center">
                                        <div class="h-10 w-10 bg-green-500 rounded-full">
                                            <svg  viewBox="0 0 44 44">
                                            <text x="50%" y="50%" dy="0.35em" fill="currentColor" font-size="20" text-anchor="middle">
                                                {{ Str::ucfirst($order->address->name[0]) }}
                                            </text>
                                        </svg>
                                        </div>
                                    </span>
                                    <div class="flex-grow">
                                        <span class="flex justify-between">
                                            <span class="from"> {{ $order->address->name }} </span>
                                            <span class="time">{{ $order->created_at->diffForHumans() }} </span>
                                        </span>
                                        <span class="message"> {{ $order->address->phone }} - {{ $order->address->email }} </span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </x-slot>
    </x-dropdown>
</div>