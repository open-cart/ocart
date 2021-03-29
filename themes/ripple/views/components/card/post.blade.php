@props(['data' => null])
@if($data)
    <a href="/post/{{ $data->id }}" class="h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-60 overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ TnMedia::url(head($data->images)) }}" alt="{{ $data->name }}">
        </div>
        <div class="p-4">
            <h2 class="mt-2 mb-2 font-bold">{{ $data->name }}</h2>
            <p class="text-sm text-gray-500 line-clamp-3">{!! $data->description !!}</p>
        </div>
    </a>
@endif
