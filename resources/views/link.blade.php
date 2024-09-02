<x-layout>
    <div class="container px-4 py-8">
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
                            @if (auth()->user())
                                <td class="px-6 py-4">
                                    <button class="edit-btn text-blue-500 hover:text-blue-700"
                                        data-id="{{ $link->id }}">Edit</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Edit -->
        <div id="editModal" class="z-50 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                <h2 class="text-xl font-semibold mb-4">Edit Link</h2>
                <form id="editForm">
                    <input type="hidden" id="edit-id" name="id">

                    <div class="mb-4">
                        <label for="edit-link_name" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" id="edit-link_name" name="link_name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="edit-url" class="block text-sm font-medium text-gray-700">URL</label>
                        <input type="text" id="edit-url" name="url"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="edit-instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                        <input type="text" id="edit-instansi" name="instansi"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
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


                    <div class="mb-4">
                        <label for="edit-vpn" class="block text-sm font-medium text-gray-700">VPN</label>
                        <select id="edit-vpn" name="vpn"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" id="cancelEditBtn"
                            class="bg-gray-300 px-4 py-2 rounded-md text-white">Batal</button>
                        <button type="submit" class="bg-blue-500 px-4 py-2 rounded-md text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>



    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.tailwindcss.js"></script>

    <script>
        $(document).ready(function() {
            // Atur token CSRF untuk permintaan AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var row = $(this).closest('tr');
                var linkName = row.find('td:eq(0) a').text().trim();
                var url = row.find('td:eq(0) a').attr('href').trim();
                var instansi = row.find('td:eq(2)').text().trim();
                var sectionId = row.find('td:eq(1)').text().trim();
                var vpn = row.find('td:eq(0) span').text().trim() === 'VPN!' ? '1' : '0';
                console.log(vpn);


                // Populate the modal fields
                $('#edit-id').val(id);
                $('#edit-link_name').val(linkName);
                $('#edit-url').val(url);
                $('#edit-instansi').val(instansi);
                var sectionDropdown = $('#edit-section');
                sectionDropdown.val(sectionId); // Set nilai dropdown section

                // Set nilai dropdown section berdasarkan nama
                sectionDropdown.find('option').each(function() {
                    if ($(this).text().trim() === sectionId) {
                        $(this).prop('selected', true);
                    }
                });
                $('#edit-vpn').val(vpn);

                $('#editModal').removeClass('hidden');
            });

            $('#cancelEditBtn, #closeModal').on('click', function() {
                $('#editModal').addClass('hidden');
            });

            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: '/link/update', // Ganti dengan URL yang sesuai
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Link berhasil diupdate',
                            icon: 'success'
                        }).then(() => {
                            location.reload(); // Refresh halaman
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = [];

                        // Clear previous error messages
                        $('.error-message').remove();

                        // Show error messages for each input
                        $.each(errors, function(key, value) {
                            $('#' + key).after(
                                '<span class="error-message text-red-500">' + value[
                                    0] + '</span>');
                            errorMessages.push(value[0]);
                        });

                        // Create a combined error message
                        var combinedErrorMessage = errorMessages.join(' | ');

                        Swal.fire({
                            title: 'Gagal',
                            text: 'Terjadi kesalahan: ' + combinedErrorMessage,
                            icon: 'error'
                        });
                    }
                });
            });

            $(window).on('click', function(event) {
                if ($(event.target).is('#editModal')) {
                    $('#editModal').addClass('hidden');
                }
            });
        });
    </script>



</x-layout>
