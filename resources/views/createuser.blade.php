<x-layout>
    <div class="container mx-auto px-4 pt-8">
        <h2>Akun</h2>
        <h1 class="text-3xl font-bold mb-6">Buat Akun</h1>
    </div>
    <div class="container mx-auto px-10 md:px-40 pt-0 pb-8">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-2 w-full">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name"
                    class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div class="mb-2">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div class="mb-2">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div class="mb-2">
                <label for="section_id" class="block text-gray-700">Seksi</label>
                <select name="section_id" id="section_id"
                    class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Pilih seksi</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label for="role" class="block text-gray-700">Role</label>
                <select name="role" id="role"
                    class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Buat
                    Akun</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle successful creation
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Berhasil membuat akun baru.',
                    text: '{{ session('success') }}'
                });
            @endif

            // Handle validation errors
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan dalam pengisian form.',
                    footer: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
                });
            @endif
        });
    </script>
</x-layout>
