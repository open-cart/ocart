@props(['checked', 'color' => 'indigo', 'name' => ''])
<span x-data="{ isOn: {!! $checked !!} }" {{ $attributes }}>
    <input type="hidden" :value="isOn ? 1 : 2" name="{!! $name !!}"/>
    <span
        x-on:click="$dispatch('change', isOn = !isOn)"
        :aria-checked="isOn"
        :class="{'bg-{!! $color !!}-600': isOn, 'bg-gray-200': !isOn }"
        class="bg-gray-200 relative inline-block flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline"
        role="checkbox"
        tabindex="0"
    >
      <span
          aria-hidden="true"
          :class="{'translate-x-5': isOn, 'translate-x-0': !isOn }"
          class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"
      ></span>
    </span>
</span>
