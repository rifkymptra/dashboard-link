<x-layout>
    <div class="container px-4 py-8" x-data="{ showEditModal: false }">
        <h2 class="">Beranda</h2>
        <h1 class="text-3xl font-bold mb-4">Selamat datang!</h1>

        <!-- Filter Section -->
        <div class="mb-4" x-data="{ openFilter: false }">
            <div class="mb-4">
                <div class="inline-flex items-center cursor-pointer" @click="openFilter = !openFilter">
                    <h3 class="text-base font-semibold">Filter berdasarkan kategori</h3>
                    <img :class="{ 'rotate-180': openFilter }" src="{{ asset('svg/chevron-down.svg') }}" alt="Filter"
                        class="h-6 w-6 transition-transform duration-300">
                </div>
                <form id="filter-form" x-show="openFilter" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
                        @foreach ($sections as $section)
                            <label
                                class="my-1 mx-2 flex items-center space-x-2 p-2 border rounded-lg shadow-sm hover:bg-gray-100">
                                <input type="checkbox" name="sections[]" value="{{ $section->id }}"
                                    class="section-filter">
                                <span class="ml-2 text-sm font-medium">{{ $section->section_name }}</span>
                            </label>
                        @endforeach
                    </div>
                </form>
            </div>

            <div class="flex items-center mb-4">
                <input type="text" id="search" placeholder="Search..."
                    class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                <a href="/export-links"
                    class="ml-2 mt-2 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Export Excel
                    </span>
                </a>
                <a href="/link/create"
                    class="ml-2 relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Tambah Link
                    </span>
                </a>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Deskripsi</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">URL</th>
                            @if (auth()->user()->role === 'admin')
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="links-table-body">
                        @foreach ($links as $link)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $link->link_name }} @if ($link->vpn)
                                        <span class="bg-cyan-400 p-1 text-[10px] font-bold rounded-full">
                                            VPN!
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $link->description_link }}</td>
                                <td class="px-6 py-4">{{ $link->sectionId->section_name }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ $link->url }}"
                                        class="text-blue-600 hover:underline">{{ $link->url }}</a>
                                </td>
                                @if (auth()->user()->role === 'admin')
                                    <td class="px-6 py-4 text-right">
                                        <button @click="editLink({{ $link->id }})"
                                            class="font-medium text-blue-600 hover:underline">Edit</button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation example" class="py-8">
                <ul class="flex items-center -space-x-px h-10 text-base">
                    <!-- Pagination links here -->
                    <li>
                        <a href="{{ $links->previousPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $links->lastPage(); $i++)
                        <li>
                            <a href="{{ $links->url($i) }}"
                                class="flex items-center justify-center px-4 h-10 leading-tight {{ $links->currentPage() == $i ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor
                    <li>
                        <a href="{{ $links->nextPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Edit Modal -->
        <div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50"
            x-show="showEditModal" @keydown.escape.window="showEditModal = false"
            @click.outside="showEditModal = false; console.log('Modal closed');">
            <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-lg">
                <h3 class="text-xl font-bold mb-4">Edit Link</h3>
                <form id="edit-form" method="POST" action="{{ route('links.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-link-id">
                    <div class="mb-4">
                        <label for="edit-link-name" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="link_name" id="edit-link-name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="edit-description-link"
                            class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description_link" id="edit-description-link"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            rows="3" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="edit-url" class="block text-sm font-medium text-gray-700">URL</label>
                        <input type="text" name="url" id="edit-url"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="edit-vpn" class="block text-sm font-medium text-gray-700">VPN</label>
                        <select name="vpn" id="edit-vpn"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit-section" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="section_id" id="edit-section"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Simpan</button>
                        <button type="button" @click="!showEditModal; console.log(showEditModal)" id="close_modal"
                            class="ml-4 px-4 py-2 bg-gray-300 text-gray-800 rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Batal</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchLinks(query, sections) {
                $.ajax({
                    url: '{{ route('links.search') }}',
                    method: 'GET',
                    data: {
                        search: query,
                        sections: sections
                    },
                    success: function(response) {
                        $('#links-table-body').html(response);
                    }
                });
            }

            function fetchLinkData(id) {
                $.ajax({
                    url: '{{ url('links') }}/' + id + '/edit',
                    method: 'GET',
                    success: function(response) {
                        $('#edit-link-id').val(response.id);
                        $('#edit-link-name').val(response.link_name);
                        $('#edit-description-link').val(response.description_link);
                        $('#edit-url').val(response.url);
                        $('#edit-section').val(response.section_id);
                        $('#edit-vpn').val(response.vpn);
                        $('#edit-modal').show();
                    }
                });
            }

            $('#search').on('input', function() {
                let query = $(this).val();
                let sections = [];
                $('.section-filter:checked').each(function() {
                    sections.push($(this).val());
                });
                fetchLinks(query, sections);
            });

            $('.section-filter').on('change', function() {
                let query = $('#search').val();
                let sections = [];
                $('.section-filter:checked').each(function() {
                    sections.push($(this).val());
                });
                fetchLinks(query, sections);
            });

            window.editLink = function(id) {
                fetchLinkData(id);
            };
        });

        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                Swal.fire({
                    title: 'Sukses',
                    text: '{{ Session::get('success') }}',
                    icon: 'success'
                });
            @elseif (Session::has('error'))
                Swal.fire({
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}',
                    icon: 'error'
                });
            @endif
        });
    </script>
</x-layout>
