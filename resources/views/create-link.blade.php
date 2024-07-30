<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Tambah Link Baru</h1>

        <form id="create-link-form" action="{{ route('links.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="link_name" class="block text-sm font-medium text-gray-700">Judul Link</label>
                <input type="text" id="link_name" name="link_name" required placeholder="ex: Badan Pusat Statistik"
                    class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full">
            </div>

            <div>
                <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                <input type="text" id="url" name="url" required placeholder="ex: bps.go.id"
                    class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Apakah Memerlukan VPN?</label>
                <div class="flex items-center space-x-4 mt-2">
                    <div class="flex items-center">
                        <input id="vpn_yes" type="radio" name="vpn" value="1"
                            class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                        <label for="vpn_yes" class="ml-2 text-sm font-medium text-gray-700">Ya</label>
                    </div>
                    <div class="flex items-center">
                        <input id="vpn_no" type="radio" name="vpn" value="0" checked
                            class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                        <label for="vpn_no" class="ml-2 text-sm font-medium text-gray-700">Tidak</label>
                    </div>
                </div>
            </div>

            <div>
                <label for="section_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select id="section_id" name="section_id" required
                    class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full">
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="description_link" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description_link" name="description_link" rows="4" required
                    placeholder="ex: website tempat menyediakan informasi tentang data statistik dasar dan sektoral"
                    class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full"></textarea>
            </div>

            <div>
                <button type="submit"
                    class="ml-2 relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Ajukan
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Include SweetAlert2 JavaScript from realrashid/sweet-alert -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Link berhasil diajukan.',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'OK'
                });
            @endif
        });

        document.getElementById('create-link-form').addEventListener('submit', function(event) {
            var urlInput = document.getElementById('url');
            var urlValue = urlInput.value.trim();
            if (!urlValue.startsWith('http://') && !urlValue.startsWith('https://')) {
                urlInput.value = 'https://' + urlValue;
            }
        });
    </script>
</x-layout>
