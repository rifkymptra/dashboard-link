<x-layout>
    <div class="container px-4 py-8" x-data="{ showEditModal: false }">
        <h2 class="">Daftar Link</h2>
        <h1 class="text-3xl font-bold mb-4">Selamat datang!</h1>

        <div class="flex items-center mb-4">

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

        <div id="filter-container" class="mb-4">
            <div class="flex space-x-4">
                <div>
                    <label for="filter-category" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="filter-category"
                        class="mt-1 block w-full rounded-lg hover:cursor-pointer hover:bg-gray-100">
                        <option value="">Pilih Kategori</option>
                    </select>
                </div>
                <div>
                    <label for="filter-instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                    <select id="filter-instansi"
                        class="mt-1 block w-full rounded-lg hover:cursor-pointer hover:bg-gray-100">
                        <option value="">Pilih Instansi</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto p-2 border">
            <table id="linkTable"
                class="w-full text-xs md:text-sm text-left rtl:text-right text-black dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Judul</th>
                        <th scope="col" class="px-6 py-3 hidden md:table-cell">Kategori</th>
                        <th scope="col" class="px-6 py-3">Instansi</th>
                        <th scope="col" class="px-6 py-3">Deskripsi</th>
                        @if (auth()->user())
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="links-table-body">
                    @foreach ($links as $link)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 text-blue-600 font-semibold"> <a class="hover:underline"
                                    href="{{ $link->url }}">
                                    {{ $link->link_name }} </a>
                                @if ($link->vpn)
                                    <span
                                        class="bg-yellow-300 p-1 text-[8px] md:text-[10px] font-bold text-black rounded-full">
                                        VPN!
                                    </span>
                                @endif

                            </td>
                            <td class="px-6 py-4 hidden md:table-cell">{{ $link->sectionId->section_name }}</td>
                            <td class="px-6 py-4">{{ $link->instansi }}</td>
                            <td class="px-6 py-4 whitespace-normal">{{ $link->description_link }}</td>
                            {{-- <td class="px-6 py-4">
                                    <a href="{{ $link->url }}"
                                        class="text-blue-600 hover:underline">{{ $link->url }}</a>
                                </td> --}}
                            @if (auth()->user())
                                <td class="px-6 py-4 text-right">
                                    <button
                                        @click="editLink({{ $link->id }}); showEditModal = true; console.log({{ $link->id }});"
                                        class="edit-button font-medium text-blue-600 hover:underline">Edit</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Edit Modal -->
        @if (auth()->user())
            <div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50"
                x-show="showEditModal" @keydown.escape.window="showEditModal = false"
                @click.outside="showEditModal = false;">
                <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-lg" @click.stop>
                    <h3 class="text-xl font-bold mb-4">Edit Link</h3>
                    <form id="edit-form" method="POST" action="{{ route('links.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-link-id">
                        <div class="mb-4">
                            <label for="edit-link-name" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="link_name" id="edit-link-name"
                                class="mt-0 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="edit-description-link"
                                class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="description_link" id="edit-description-link"
                                class="mt-0 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                rows="3" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="edit-url" class="block text-sm font-medium text-gray-700">URL</label>
                            <input type="text" name="url" id="edit-url"
                                class="mt-0 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="edit-vpn" class="block text-sm font-medium text-gray-700">VPN</label>
                            <select name="vpn" id="edit-vpn"
                                class="mt-0 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="edit-section" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="section_id" id="edit-section"
                                class="mt-0 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="edit-instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                            <input type="text" name="instansi" id="edit-instansi"
                                class="mt-0 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div class="flex justify-end mt-1">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Simpan</button>
                            <button type="button" @click="showEditModal = false"
                                class="ml-4 px-4 py-2 bg-gray-300 text-gray-800 rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.tailwindcss.js"></script>

    <script>
        $(document).ready(function() {

            $('#linkTable').DataTable({
                layout: {
                    topStart: {
                        search: {
                            placeholder: 'Cari Website...',
                            text: ''
                        }
                    },
                    topEnd: 'pageLength',
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                },
                initComplete: function() {
                    var api = this.api();

                    // Kolom kedua (index 1)
                    var columnCategory = api.column(1);
                    var selectCategory = $('#filter-category');
                    selectCategory.empty();

                    selectCategory.append('<option value="">Pilih Kategori</option>');

                    columnCategory
                        .data()
                        .unique()
                        .sort()
                        .each(function(d) {
                            selectCategory.append('<option value="' + d + '">' + d + '</option>');
                        });

                    selectCategory.on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        columnCategory.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                    // Kolom ketiga (index 2)
                    var columnInstansi = api.column(2);
                    var selectInstansi = $('#filter-instansi');
                    selectInstansi.empty();

                    selectInstansi.append('<option value="">Pilih Instansi</option>');

                    columnInstansi
                        .data()
                        .unique()
                        .sort()
                        .each(function(d) {
                            selectInstansi.append('<option value="' + d + '">' + d + '</option>');
                        });

                    selectInstansi.on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        columnInstansi.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                }
            });

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
                        // Re-attach event listeners after content update
                        attachEventListeners();

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
                        $('#edit-instansi').val(response.instansi);
                        $('#edit-url').val(response.url);
                        $('#edit-section').val(response.section_id);
                        $('#edit-vpn').val(response.vpn);
                        showEditModal = true;
                    }
                });
            }

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
