<div class="w-1/4 p-3">
    <div class="content">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg w-64
        border border-white
        dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-gray-500 uppercase font-bold text-xs dark:text-gray-300">
                            {!! $widget->title !!}
                        </h5>
                        <span class="font-semibold text-xl text-gray-800 dark:text-gray-500">
                            {!! $widget->total !!}
                        </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-indigo-600">
                            <i class="{!! $widget->icon ?? 'fa fa-users' !!}"></i>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4 flex">
      <span class="flex mr-2 text-green-500">
        <svg fill="#48bb78" width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1675 971q0 51-37 90l-75 75q-38 38-91 38-54 0-90-38l-294-293v704q0 52-37.5 84.5t-90.5 32.5h-128q-53 0-90.5-32.5t-37.5-84.5v-704l-294 293q-36 38-90 38t-90-38l-75-75q-38-38-38-90 0-53 38-91l651-651q35-37 90-37 54 0 91 37l651 651q37 39 37 91z"/></svg>
        4.5%
      </span>
                    <span class="whitespace-no-wrap">
        Since last week
      </span>
                </p>
            </div>
        </div>
    </div>
</div>