@foreach ($users as $user)
    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $user->name }}
        </th>
        <td class="px-6 py-4">{{ $user->email }}</td>
        <td class="px-6 py-4">{{ $user->section->section_name }}</td>
        <td class="px-6 py-4">{{ $user->role }}</td>
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
