@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-spons_blue focus:ring-spons_blue rounded-md shadow-sm']) !!}>
