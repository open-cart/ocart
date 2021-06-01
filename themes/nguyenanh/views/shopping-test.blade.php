<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @php
        Cart::add(['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'weight' => 550, 'options' => ['size' => 'large']]);
    @endphp
    <div>test</div>
</x-guest-layout>
