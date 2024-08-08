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
