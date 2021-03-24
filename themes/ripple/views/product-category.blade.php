<x-guest-layout>
    <div>{{ $category }}</div>


    @foreach($products as $product)
        {!! $product !!}
    @endforeach

</x-guest-layout>
