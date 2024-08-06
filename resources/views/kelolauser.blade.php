<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Akun</h1>

        <!-- Filter Section -->
        <div class="mb-4" x-data="{ openFilter: false }">
            <div class="flex items-center mb-4">
                <input type="text" id="search" placeholder="Search..."
                    class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                <a href="/users/create"
                    class="ml-2 relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-opacity-0">
                        Tambah Akun
                    </span>
                </a>
            </div>

            <div class="inline-flex items-center cursor-pointer" @click="openFilter = !openFilter">
                <h3 class="text-base font-semibold">Filter berdasarkan kategori</h3>
                <img :class="{ '-rotate-0': openFilter, '-rotate-90': !openFilter }"
                    src="{{ asset('svg/chevron-down.svg') }}" alt="Filter"
                    class="h-6 w-6 transition-transform duration-300 ml-2">
            </div>
            <form id="filter-form" x-show="openFilter" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4"
                class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($sections as $section)
                    <label class="flex items-center space-x-2 p-2 border rounded-lg shadow-sm hover:bg-gray-100">
                        <input type="checkbox" name="sections[]" value="{{ $section->id }}" class="section-filter">
                        <span class="text-sm font-medium">{{ $section->section_name }}</span>
                    </label>
                @endforeach
            </form>
        </div>

        <!-- User Table -->
        <div id="user-table-container" class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @include('partials.users', ['users' => $users])
            <table class="w-full text-sm text-left text-black bg-white border border-gray-200">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 border-b">Nama</th>
                        <th class="px-4 py-2 border-b">Email</th>
                        <th class="px-4 py-2 border-b">Seksi</th>
                        <th class="px-4 py-2 border-b">Role</th>
                        <th class="px-4 py-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->section->section_name }}</td>
                            <td class="px-4 py-2">{{ $user->role }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <!-- Edit Button -->
                                <button
                                    onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->section->id }}', '{{ $user->role }}')"
                                    class="text-blue-600 hover:text-blue-800">
                                    <img src="{{ asset('svg/edit-biru.svg') }}" alt="Edit" class="w-6 h-6">
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <img src="{{ asset('svg/x-merah.svg') }}" alt="Delete" class="w-6 h-6">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="edit-user-modal" class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4">Edit User</h2>
            <form id="edit-user-form">
                @csrf
                @method('PUT')
                <input type="hidden" id="user-id" name="user_id">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" required
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 w-full">
                </div>
                <div class="mb-4">
                    <label for="section_id" class="block text-sm font-medium text-gray-700">Section</label>
                    <select name="section_id" id="section_id"
                        class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Pilih seksi</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role" required
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-lg w-full">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, email, sectionId, role) {
            document.getElementById('user-id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
            document.getElementById('section_id').value = sectionId;
            document.getElementById('role').value = role;

            document.getElementById('edit-user-modal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('edit-user-modal').classList.add('hidden');
        }

        document.getElementById('edit-user-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let userId = document.getElementById('user-id').value;

            fetch(`/users/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(Object.fromEntries(formData)),
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'User Updated',
                        text: 'User details have been updated successfully!',
                    }).then(() => {
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Failed',
                        text: 'An error occurred while updating the user.',
                    });
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const filterForm = document.getElementById('filter-form');
            const userTableContainer = document.getElementById('user-table-container');

            function fetchData() {
                const search = searchInput.value;
                const formData = new FormData(filterForm);
                formData.append('search', search);

                fetch('{{ route('users.kelola') }}?' + new URLSearchParams(formData).toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        userTableContainer.innerHTML = data;
                    });
            }

            searchInput.addEventListener('input', fetchData);
            filterForm.addEventListener('change', fetchData);
        });
    </script>
</x-layout>
