@props(['active'])

@if (Request()->route()->getName() == 'profile' ||
        Request()->route()->getName() == 'dashboard' ||
        Request()->route()->getName() == 'admindashboard')
    @php
        $classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 text-base font-medium  text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 text-base font-medium  text-white hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
    @endphp
@else
    @php
        $classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 text-base font-medium  text-black focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 text-base font-medium  text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
    @endphp
@endif

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
