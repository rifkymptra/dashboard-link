<x-layout>
    <div class="container mx-auto px-3 py-4 md:py-8">
        <h2 class="">Approval</h2>
        <h1 class="text-3xl font-bold mb-4">Selamat datang!</h1>

        <div class="flex flex-col sm:flex-row items-center mb-4 space-y-4 sm:space-y-0 sm:space-x-4">
            <input type="text" id="search" placeholder="Search..."
                class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300">

        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="min-w-fit max-w-2 text-xs md:text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">Judul</th>
                        <th scope="col" class="px-2 py-3">Deskripsi</th>
                        <th scope="col" class="px-2 py-3">Kategori</th>
                        <th scope="col" class="px-2 py-3">Instansi</th>
                        <th scope="col" class="px-2 py-3 max-w-xs">URL</th>
                        <th scope="col" class="px-2 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody id="links-table-body">
                    @foreach ($links as $link)
                        <tr
                            class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $link->link_name }}
                                @if ($link->vpn)
                                    <span
                                        class="bg-cyan-400 p-1 text-[8px] md:text-[10px] font-bold rounded-full">VPN!</span>
                                @endif
                            </th>
                            <td class="px-2 py-4">{{ $link->description_link }}</td>
                            <td class="px-2 py-4">{{ $link->sectionId->section_name }}</td>
                            <td class="px-2 py-4">{{ $link->instansi }}</td>
                            <td class="px-2 py-4 max-w-xs">
                                <a href="{{ $link->url }}"
                                    class="text-blue-600 hover:underline">{{ $link->url }}</a>
                            </td>
                            <td class="px-2 py-4 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                <form id="approve-form-{{ $link->id }}"
                                    action="{{ route('approval.accept', $link->id) }}" method="POST"
                                    class="w-full sm:w-auto">
                                    @csrf
                                    <button type="submit"
                                        class="approveButton text-xs md:text-sm w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-0 py-2 md:px-5 md:py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setuju</button>
                                </form>
                                <form id="reject-form-{{ $link->id }}"
                                    action="{{ route('approval.reject', $link->id) }}" method="POST"
                                    class="w-full sm:w-auto">
                                    @csrf
                                    <button type="submit"
                                        class="rejectButton text-xs md:text-sm w-full sm:w-auto text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full px-3 py-2 md:px-5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Tolak</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation example" class="py-8">
            <ul class="flex items-center -space-x-px h-10 text-base">
                <li>
                    <a href="{{ $links->previousPageUrl() }}"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
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
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Next</span>
                        <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchLinks(query, sections) {
                $.ajax({
                    url: '{{ route('links.approval') }}',
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

            function attachEventListeners() {
                document.querySelectorAll('.approveButton').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent default form submission

                        const formId = this.closest('form').id;
                        const linkId = formId.split('-')[2];

                        Swal.fire({
                            title: 'Catatan',
                            input: 'textarea',
                            inputPlaceholder: 'Masukkan catatanmu...',
                            inputAttributes: {
                                'aria-label': 'Masukkan catatanmu'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Approve',
                            cancelButtonText: 'Cancel',
                            showLoaderOnConfirm: true,
                            preConfirm: (note) => {
                                return fetch(`/link/approval/${linkId}/accept`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]')
                                                .getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            note: note
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (!data.success) {
                                            throw new Error(data.message);
                                        }
                                        return data;
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            `Request failed: ${error.message}`);
                                    });
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Link diterima dan note telah ditambahkan.',
                                    icon: 'success'
                                }).then(() => {
                                    location
                                        .reload(); // Refresh the page to see updated data
                                });
                            }
                        });
                    });
                });

                document.querySelectorAll('.rejectButton').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent default form submission

                        const formId = this.closest('form').id;
                        const linkId = formId.split('-')[2];

                        Swal.fire({
                            title: 'Catatan',
                            input: 'textarea',
                            inputPlaceholder: 'Masukkan catatanmu...',
                            inputAttributes: {
                                'aria-label': 'Masukkan catatanmu'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Reject',
                            cancelButtonText: 'Cancel',
                            showLoaderOnConfirm: true,
                            preConfirm: (note) => {
                                return fetch(`/link/approval/${linkId}/reject`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]')
                                                .getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            note: note
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (!data.success) {
                                            throw new Error(data.message);
                                        }
                                        return data;
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            `Request failed: ${error.message}`);
                                    });
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Rejected!',
                                    text: 'Link berhasil ditolak dan note telah ditambahkan.',
                                    icon: 'error'
                                }).then(() => {
                                    location
                                        .reload(); // Refresh the page to see updated data
                                });
                            }
                        });
                    });
                });
            }

            // Initialize event listeners
            attachEventListeners();

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
        });
    </script>

</x-layout>
