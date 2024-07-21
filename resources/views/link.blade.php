<x-layout>
    <div class="container mx-auto">
        <div class="mb-4">
            <form method="GET" action="{{ url('/users') }}">
                <input type="text" name="search" value="" placeholder="Search..."
                    class="px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Search</button>
            </form>
        </div>
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Role</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    {{-- @foreach ($users as $user) --}}
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150"
                                    alt="Profile Image">
                                <span class="ml-3">
                                    {{-- {{ $user->name }} --}}
                                    Rifky Maulana Putra
                                </span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span>
                                    {{-- {{ $user->title }} --}}
                                    arigato
                                </span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                                {{-- {{ $user->status }} --}}
                                Active
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span>
                                {{-- {{ $user->role }} --}}
                                Admin
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <a href="#" class="text-blue-500">Edit</a>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{-- {{ $users->links() }} --}} www.instagram.com
        </div>
    </div>
</x-layout>
