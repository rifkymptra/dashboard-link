<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Akun</h1>

        <div class="flex items-center mb-4">
            <input type="text" id="search" placeholder="Search..."
                class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300">
            <a href="/users/create"
                class="ml-2 relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                <span
                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Tambah Akun
                </span>
            </a>
        </div>

        <table class="w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Email</th>
                    <th class="px-4 py-2 border-b">Seksi</th>
                    <th class="px-4 py-2 border-b">Role</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                        <td class="px-4 py-2 border-b">{{ $user->section->section_name }}</td>
                        <td class="px-4 py-2 border-b">{{ $user->role }}</td>
                        <td class="px-4 py-2 border-b flex space-x-2">
                            <!-- Edit Button -->
                            <button
                                onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->section->id }}', '{{ $user->role }}')"
                                class="text-blue-600 hover:text-blue-800">
                                <img src="{{ asset('svg/edit-biru.svg') }}" alt="" class="w-6 h-6">
                            </button>
                            <!-- Delete Button -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <img src="{{ asset('svg/x-merah.svg') }}" alt="w-6 h-6">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="edit-user-modal" class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
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
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        name: formData.get('name'),
                        email: formData.get('email'),
                        section_id: formData.get('section_id'),
                        role: formData.get('role'),
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeEditModal();
                        location.reload(); // Refresh the page to see the updated data
                    } else {
                        alert('Error updating user');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</x-layout>
