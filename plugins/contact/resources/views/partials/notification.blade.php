<div class="flex items-center">
    <x-dropdown align="right" width="60">
        <x-slot name="trigger">
            <div class="cursor-pointer">
                <span class="relative inline-block">
  <img src="/images/email.svg" class="w-5 h-5 mx-3"/>
   <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none
    text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $contacts->count() }}</span>
</span>
            </div>
        </x-slot>
        <x-slot name="content">
            <ul class="text-sm -mt-1">
                <li class="flex justify-between px-3 py-5 bg-gray-100">
                    <h3>{!! trans('plugins/contact::contact.new_msg_notice', ['count' => count($contacts)]) !!}</h3>
                    <a class="text-blue-500 hover:text-blue-600" href="{{ route('contacts.index') }}">{{ trans('plugins/contact::contact.view_all') }}</a>
                </li>
                <li>
                    <ul class="overflow-auto" style="max-height: 440px; {{ count($contacts) * 72 }}px;" data-handle-color="#637283">
                        @foreach($contacts as $contact)
                            <li>
                                <a class="flex space-x-3 py-4 px-3 hover:bg-gray-50" href="{{ route('contacts.update', $contact->id) }}">
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