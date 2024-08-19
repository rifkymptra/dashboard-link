<div x-data="{ open: true }" x-init="if (window.matchMedia('(max-width: 768px)').matches) {
    open = false;
}" @toggle-sidebar.window="open = $event.detail.open"
    :class="open ? 'w-64' : 'w-0'"
    class="@if (!auth()->user()) md:hidden lg:hidden) @endif bg-white text-black min-h-screen transition-all duration-300 fixed md:relative z-40 md:z-auto border-r border-gray-200 top-0 md:top-2">
    <nav class="mt-10 pt-8 transition-all duration-300 h-fit md:h-full w-64 md:fixed" :class="open ? 'block' : 'hidden'">
        <a href="/beranda"
            class="block py-2 px-4 transition duration-200 hover:bg-gray-200
            @if (Request::is('beranda')) bg-gray-200 @endif">
            <img src="{{ asset('svg/home.svg') }}" class="inline-block h-6 w-6 mr-3" />
            <span :class="open ? 'inline' : 'hidden'">Beranda</span>
        </a>
        <div x-data="{ openLink: '{{ Request::is('link', 'link/create') ? 'true' : 'false' }}' === 'true' }">
            <button @click="openLink = !openLink"
                class="flex justify-between w-full py-2 px-4 transition duration-200 hover:bg-gray-200">
                <span class="flex items-center">
                    <img src="{{ asset('svg/Link.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Link</span>
                </span>
                <img src="{{ asset('svg/chevron-down.svg') }}" :class="{ 'rotate-180': openLink }"
                    class="h-5 w-5 transition-transform duration-800" />
            </button>
            <div x-show="openLink" class="pl-4">
                <a href="/link"
                    class="block py-2 px-4 transition duration-200 hover:bg-gray-200
                        @if (Request::is('link')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/file-text.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Daftar</span>
                </a>
                <a href="/link/create"
                    class="block py-2 px-4 transition duration-200 hover:bg-gray-200
                        @if (Request::is('link/create')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/file-plus.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Tambah</span>
                </a>
            </div>
        </div>

        <!-- Only show this section if the user is an admin -->
        @if (auth()->user())
            <div x-data="{ openManage: '{{ Request::is('users/create', 'users/kelola', 'sections/create') ? 'true' : 'false' }}' === 'true' }">
                <button @click="openManage = !openManage"
                    class="flex justify-between w-full py-2 px-4 transition duration-200 hover:bg-gray-200">
                    <span class="flex items-center">
                        <img src="{{ asset('svg/airplay.svg') }}" class="inline-block h-6 w-6 mr-3" />
                        <span :class="open ? 'inline' : 'hidden'">Manage</span>
                    </span>
                    <img src="{{ asset('svg/chevron-down.svg') }}" :class="{ 'rotate-180': openManage }"
                        class="h-5 w-5 transition-transform duration-800" />
                </button>
                <div x-show="openManage" class="pl-4">
                    <a href="/users/create"
                        class="block py-2 px-4 transition duration-200 hover:bg-gray-200
                        @if (Request::is('users/create')) bg-gray-200 @endif">
                        <img src="{{ asset('svg/user-plus.svg') }}" class="inline-block h-6 w-6 mr-3" />
                        <span :class="open ? 'inline' : 'hidden'">Buat Akun</span>
                    </a>
                    <a href="/users/kelola"
                        class="block py-2 px-4 transition duration-200 hover:bg-gray-200
                        @if (Request::is('users/kelola')) bg-gray-200 @endif">
                        <img src="{{ asset('svg/edit.svg') }}" class="inline-block h-6 w-6 mr-3" />
                        <span :class="open ? 'inline' : 'hidden'">Kelola Akun</span>
                    </a>
                    <a href="/sections/create"
                        class="block py-2 px-4 transition duration-200 hover:bg-gray-200
                        @if (Request::is('sections/create')) bg-gray-200 @endif">
                        <img src="{{ asset('svg/category.svg') }}" class="inline-block h-6 w-6 mr-3" />
                        <span :class="open ? 'inline' : 'hidden'">Buat Kategori</span>
                    </a>
                </div>
            </div>


            <div x-data="{ openPengajuan: '{{ Request::is('link/approval', 'pengajuan') ? 'true' : 'false' }}' === 'true' }">
                <button @click="openPengajuan = !openPengajuan"
                    class="flex justify-between w-full py-2.5 px-4 transition duration-200 hover:bg-gray-200">
                    <span class="flex items-center">
                        <img src="{{ asset('svg/book.svg') }}" class="inline-block h-6 w-6 mr-3" />
                        <span :class="open ? 'inline' : 'hidden'">Pengajuan</span>
                    </span>
                    <img src="{{ asset('svg/chevron-down.svg') }}" :class="{ 'rotate-180': openPengajuan }"
                        class="h-5 w-5 transition-transform duration-800" />
                </button>
                <div x-show="openPengajuan" class="pl-4">

                    <a href="/link/approval"
                        class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200
            @if (Request::is('link/approval')) bg-gray-200 @endif">
                        <img src="{{ asset('svg/approve.svg') }}" class="inline-block h-6 w-6 mr-3" />
                        <span :class="open ? 'inline' : 'hidden'">Approval</span>
                    </a>

                    <a href="/pengajuan"
                        class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200
            @if (Request::is('pengajuan')) bg-gray-200 @endif">
                        <img src="{{ asset('svg/dashboard.svg') }}" class="inline-block h-6 w-6 mr-3" />
                        <span :class="open ? 'inline' : 'hidden'">Dashboard</span>
                    </a>
                </div>
            </div>


            <a href="/reports"
                class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200
            @if (Request::is('reports')) bg-gray-200 @endif">
                <img src="{{ asset('svg/user.svg') }}" class="inline-block h-6 w-6 mr-3" />
                <span :class="open ? 'inline' : 'hidden'">Kunjungan</span>
            </a>
        @endif
    </nav>
</div>
