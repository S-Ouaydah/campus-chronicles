@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-black border-2 focus:border-[#71C719] focus:ring-[#71C719] rounded-2xl']) !!} style="-webkit-box-shadow: 0 0 0 40px white inset !important;
    background-color: none !important;
}">
