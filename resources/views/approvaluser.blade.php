<!-- resources/views/approvaluser.blade.php -->
<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="">Dashboard Pengajuan</h2>
        <h1 class="text-3xl font-bold mb-4">Selamat datang!</h1>

        <div class="flex flex-col sm:flex-row items-center mb-4">
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
                        <th scope="col" class="px-2 sm:px-6 py-3">URL</th>
                        <th scope="col" class="px-2 sm:px-6 py-3">Status</th>
                        <th scope="col" class="px-2 sm:px-6 py-3">Catatan</th>
                    </tr>
                </thead>
                <tbody id="links-table-body">
                    @foreach ($links as $link)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-2 sm:px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $link->link_name }} @if ($link->vpn)
                                    <span class="bg-cyan-400 p-1 text-[10px] font-bold rounded-full">VPN!</span>
                                @endif
                            </td>
                            <td class="px-2 sm:px-6 py-4 text-black">{{ $link->description_link }}</td>
                            <td class="px-2 sm:px-6 py-4">
                                <a href="{{ $link->url }}"
                                    class="text-blue-600 hover:underline">{{ $link->url }}</a>
                            </td>
                            <td class="px-2 sm:px-6 py-4 text-black ">
                                <span
                                    class=" px-2 py-1 font-semibold text-xs rounded-full flex justify-center
                                {{ $link->status === 'approved' ? 'bg-blue-600' : '' }}
                                {{ $link->status === 'rejected' ? 'bg-red-600' : '' }}
                                {{ $link->status === 'submitted' ? 'bg-yellow-400' : '' }}">
                                    {{ $link->status }}
                                </span>
                            </td>
                            <td class="px-2 sm:px-6 py-4 text-black">{{ $link->note }}</td>
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
            function fetchLinks(query) {
                $.ajax({
                    url: '{{ route('approvaluser') }}',
                    method: 'GET',
                    data: {
                        search: query
                    },
                    success: function(response) {
                        $('#links-table-body').html(response);
                    }
                });
            }

            $('#search').on('input', function() {
                let query = $(this).val();
                fetchLinks(query);
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
        });
    </script>
</x-layout>
