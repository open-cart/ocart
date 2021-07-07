<div class="flex items-center">
    <x-dropdown align="right" width="60">
        <x-slot name="trigger">
            <x-link href="javascript:void(0)" class="cursor-pointer px-3">
                <span class="relative inline-block">
  <svg class="w-5 h-5 fill-current dark:text-white" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
       viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
<g>
	<g>
		<path d="M460.8,68.267H17.067l221.867,182.75L463.309,68.779C462.488,68.539,461.649,68.368,460.8,68.267z"/>
	</g>
</g>
<g>
	<g>
		<path d="M249.702,286.31c-6.288,5.149-15.335,5.149-21.623,0L0,98.406v294.127c0,9.426,7.641,17.067,17.067,17.067H460.8
			c9.426,0,17.067-7.641,17.067-17.067V100.932L249.702,286.31z"/>
	</g>
</g>
</svg>

   <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none
    text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $contacts->count() }}</span>
</span>
            </x-link>
        </x-slot>
        <x-slot name="content">
            <ul class="text-sm -mt-1">
                <li class="flex justify-between px-3 py-5 bg-gray-100 dark:bg-gray-700">
                    <h3 class="font-bold">{!! trans('plugins/contact::contact.new_msg_notice', ['count' => count($contacts)]) !!}</h3>
                    <a class="text-blue-500 hover:text-blue-600" href="{{ route('contacts.index') }}">{{ trans('plugins/contact::contact.view_all') }}</a>
                </li>
                <li>
                    <ul class="overflow-auto" style="max-height: 440px; {{ count($contacts) * 72 }}px;" data-handle-color="#637283">
                        @foreach($contacts as $contact)
                            <li class="border-t dark:border-gray-500">
                                <a class="flex space-x-3 py-4 px-3 hover:bg-gray-50 dark:hover:bg-gray-700" href="{{ route('contacts.update', $contact->id) }}">
                                    <span class="flex-none items-center">
                                        <div class="h-10 w-10 bg-green-500 rounded-full">
                                            <svg  viewBox="0 0 44 44">
                                            <text x="50%" y="50%" dy="0.35em" fill="currentColor" font-size="20" text-anchor="middle">
                                                {{ Str::ucfirst($contact->name[0]) }}
                                            </text>
                                        </svg>
                                        </div>
                                    </span>
                                    <div class="flex-grow">
                                        <span class="flex justify-between">
                                            <span class="from"> {{ $contact->name }} </span>
                                            <span class="time">{{ $contact->created_at->diffForHumans() }} </span>
                                        </span>
                                        <span class="message"> {{ $contact->phone }} - {{ $contact->email }} </span>
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