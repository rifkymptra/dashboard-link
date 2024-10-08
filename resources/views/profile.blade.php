<x-layout>
    <h2 class="text-3xl font-bold leading-7 text-gray-900">Profile</h2>
    <form action="" method="POST" class="bg-white p-6 rounded shadow-sm">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="name" id="name" value="{{ $product['name'] }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <input type="text" name="brand" id="brand" value="{{ $product['brand'] }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="text" name="price" id="price" value="{{ $product['price'] }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="Electronics" {{ $product['category'] == 'Electronics' ? 'selected' : '' }}>Electronics
                </option>
                <!-- Tambahkan kategori lainnya sesuai kebutuhan -->
            </select>
        </div>
        <div class="mb-4">
            <label for="weight" class="block text-sm font-medium text-gray-700">Item Weight (kg)</label>
            <input type="text" name="weight" id="weight" value="{{ $product['weight'] }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $product['description'] }}</textarea>
        </div>
        <div class="flex justify-between items-center">
            <button type="submit"
                class="ml-2 relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                <span
                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Update
                </span>
            </button>
            <button type="submit" formaction=""
                class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Delete</button>
        </div>
    </form>

</x-layout>
