@props(['checked', 'color' => 'bg-indigo-600', 'name' => '', 'valueTrue' => 1, 'valueFalse' => 2])
<span class="flex items-center"
      x-data="{ isOn: {!! $checked !!} }"
>
    <input
        class="hidden"
        id="{!! $name !!}"
        x-on:change="$dispatch($event.target.checked); isOn = $event.target.checked"
        type="checkbox"
        x-bind:checked="isOn"
        {{ $attributes }}
    />
    <input type="hidden" :value="isOn ? {{ $valueTrue }} : {{ $valueFalse }}" name="{!! $name !!}"/>
    <label
        :aria-checked="isOn"
        :class="{'{!! $color !!}': isOn, 'bg-gray-200': !isOn }"
        class="bg-gray-200 relative inline-block flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline"
        role="checkbox"
        tabindex="0"
        for="{!! $name !!}"
    >
      <span
          aria-hidden="true"
          :class="{'translate-x-5': isOn, 'translate-x-0': !isOn }"
          class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"
      ></span>
    </label>
</span>
