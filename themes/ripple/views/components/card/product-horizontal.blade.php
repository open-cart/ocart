@props(['data' => null])
@if($data)
    <div>
        <div class="float-left w-10">
            <img src="{{ TnMedia::url(empty($data->images) ? '/images/no-image.jpg' : head($data->images)) }}" alt="{{ $data->name }}" class="rounded-full m-w-10 h-10">
        </div>
        <div class="pl-3 flex flex-wrap">
            <div>
                <div>
                    <a href="/post/{{ $data->slug }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 line-clamp-2">{{ $data->name }}</a>
                </div>
                <div>
                    <a href="/post-category/{{ Arr::get($data->categories->first(), 'slug') }}" class="text-xs text-green-500 hover:text-blue-600 line-clamp-1">{{ Arr::get($data->categories->first(), 'name') }}</a>
                </div>
            </div>
        </div>
    </div>

@endif