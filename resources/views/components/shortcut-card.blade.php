@props(['icon', 'title', 'description', 'href'])

<a href="{{ $href }}"
    class="block bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 ease-in-out p-6">
    <div class="flex items-center space-x-4">
        <img src="{{ asset($icon) }}" class="h-10 w-10" alt="{{ $title }}">
        <div>
            <h3 class="text-xl font-semibold">{{ $title }}</h3>
            <p class="text-gray-600">{{ $description }}</p>
        </div>
    </div>
</a>
