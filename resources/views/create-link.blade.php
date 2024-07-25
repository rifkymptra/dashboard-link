<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Tambah Link Baru</h1>

        <form id="create-link-form" action="{{ route('links.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="link_name" class="block text-sm font-medium text-gray-700">Judul Link</label>
                <input type="text" id="link_name" name="link_name" required
                    class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full">
            </div>

            <div>
                <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                <input type="url" id="url" name="url" required
                    class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full">
            </div>

            <div>
                <label for="description_link" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description_link" name="description_link" rows="4" required
                    class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full"></textarea>
            </div>

            <div>
                <button type="submit"
                    class="ml-2 relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Simpan
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Add meta tags for SweetAlert2 -->
    <meta name="success-message" content="{{ session('success') }}">
    <meta name="error-message" content="{{ session('error') }}">

    <!-- Include SweetAlert2 JavaScript -->
    <script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('meta[name="success-message"]').getAttribute('content');
            const errorMessage = document.querySelector('meta[name="error-message"]').getAttribute('content');

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: successMessage,
                    confirmButtonText: 'OK'
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
</x-layout>
