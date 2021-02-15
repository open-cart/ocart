<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pb-12 pt-3" id="page-container">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        filter
                    </div>
                    <div class="flex justify-between mb-2">
                        <div>
                            {!! $table->renderBulkAction() !!}
                        </div>
                        <div>
                            @foreach($table->buttons() as $button)
                                {!! $button !!}
                            @endforeach
                        </div>
                    </div>
                    <div>
                        {!! $table->table(['class' => 'w-full']) !!}
                    </div>
                    <div class="mt-2">
                        {!! $table->data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
