@props(['data' => null])
@if($data)
    <div class="inline-block">
        <div class="float-left w-10 h-10">
            <img
                data-src="{{ TnMedia::getImageUrl(Arr::first($data->images),'thumb', asset('/images/no-image.jpg')) }}"
                src="{{ asset('/images/no-image.jpg') }}"
                alt="{{ $data->name }}"
                class="rounded-full m-w-10 w-full h-full lozad"
            >
        </div>
        <div class="pl-3 flex flex-wrap">
            <div>
                <div>
                    <a href="{!! $data->url !!}" class="font-bold text-gray-500 hover:text-blue-600 line-clamp-2">{{ $data->name }}</a>
                </div>
                @if(count($data->categories)>0)
                    <div>
                        <a href="{!! Arr::get($data->categories->first(), 'url') !!}" class="text-sm text-green-500 hover:text-blue-600 line-clamp-1">{{ Arr::get($data->categories->first(), 'name') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
