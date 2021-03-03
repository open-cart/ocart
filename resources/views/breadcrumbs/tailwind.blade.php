@if (count($breadcrumbs))
    <nav class="container">
        <ol class="flex text-gray-500 text-sm lg:text-base">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="inline-flex items-center">
                        <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                        <svg fill="currentColor" viewBox="0 0 20 20" class="h-5 w-auto text-gray-400"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </li>
                @else
                    <li class="inline-flex items-center">
                        <a href="#">{{ $breadcrumb->title }}</a>
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endif

