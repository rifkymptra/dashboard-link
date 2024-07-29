<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="">Beranda</h2>
        <h1 class="text-3xl font-bold mb-4">Selamat datang!</h1>

        <div class="flex flex-col sm:flex-row items-center mb-4">
            <input type="text" id="search" placeholder="Search..."
                class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 mb-2 sm:mb-0 sm:mr-2">
            <a href="{{ route('links.create') }}"
                class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                <span
                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Tambah Link
                </span>
            </a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 sm:px-6 py-3">Judul</th>
                        <th scope="col" class="px-2 sm:px-6 py-3">Deskripsi</th>
                        <th scope="col" class="px-2 sm:px-6 py-3">Kategori</th>
                        <th scope="col" class="px-2 sm:px-6 py-3">URL</th>
                        {{-- <th scope="col" class="px-2 sm:px-6 py-3">Status</th> --}}
                        <th scope="col" class="px-2 sm:px-6 py-3">Aksi</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody id="links-table-body">
                    @foreach ($links as $link)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $link->link_name }} @if ($link->vpn)
                                    <span class="bg-cyan-400 p-1 text-[10px] font-bold rounded-full">
                                        VPN!
                                    </span>
                                @endif
                            </th>
                            <td class="px-2 sm:px-6 py-4">{{ $link->description_link }}</td>
                            <td class="px-2 sm:px-6 py-4">{{ $link->submittedBy->section->section_name }}</td>
                            <td class="px-2 sm:px-6 py-4">
                                <a href="{{ $link->url }}"
                                    class="text-blue-600 hover:underline">{{ $link->url }}</a>
                            </td>
                            {{-- <td class="px-2 sm:px-6 py-4">{{ $link->status }}</td> --}}
                            <td
                                class="px-2 sm:px-6 py-8 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 ">
                                <form action="{{ route('approval.accept', $link->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setujui</button>
                                </form>
                                <form action="{{ route('approval.reject', $link->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full sm:w-auto text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Tolak</button>
                                </form>
                            </td>
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
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('Sukses'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('Sukses') }}',
                    timer: 1500,
                    showConfirmButton: false
                });
            @endif

            const acceptForms = document.querySelectorAll('form[action*="accept"]');
            const rejectForms = document.querySelectorAll('form[action*="reject"]');

            acceptForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda akan menyetujui link ini.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, setujui!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            rejectForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda akan menolak link ini.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-layout>
