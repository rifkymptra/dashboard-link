@props(['active ' => false])
<a {{ $attributes }}
    class="{{ $active ? 'bg-gray-300 text-black' : 'text-black hover:bg-gray-300 hover:text-black' }} inline-block h-6 w-6 mr-3"
    aria-current="{{ $active ? 'page' : 'false' }}">{{ $slot }}>

</a>
