@foreach($tags as $tag)
    <div class="cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-600 px-3 py-2"
         x-on:click='change(@json($tag))'>
        <div class="pl-2">
            <template x-if="selected.some(x => x.id == {{ $tag->id }})">
                <x-icons.check class="h-4 w-4 inline-block text-green-500"/>
            </template>
            <template x-if="!selected.some(x => x.id == {{ $tag->id }})">
                <span class="w-4 inline-block"></span>
            </template>
            <span class="pl-2">{!! $tag->name !!}</span>
        </div>
    </div>
    @if($loop->last)
        <hr class="-mx-3 dark:border-gray-600">
    @else
        <hr class="dark:border-gray-600">
    @endif
@endforeach