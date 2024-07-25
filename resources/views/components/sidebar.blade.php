<div :class="open ? 'w-64' : 'w-0'"
    class="bg-white text-black min-h-screen transition-all duration-300 fixed md:relative z-40 md:z-auto border-r border-gray-200 top-5">
    <nav class="mt-10 pt-8 transition-all duration-300" :class="open ? 'block' : 'hidden'">
        <a href="/beranda"
            class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200
            @if (Request::is('beranda')) bg-gray-200 @endif">
            <img src="{{ asset('svg/home.svg') }}" class="inline-block h-6 w-6 mr-3" />
            <span :class="open ? 'inline' : 'hidden'">Beranda</span>
        </a>
        <div x-data="{
            openSection: '{{ Request::is('Kategori/*') ? 'true' : 'false' }}' === 'true',
            openManage: '{{ Request::is('link/create', 'link/approval', 'users/create', 'users/kelola') ? 'true' : 'false' }}' === 'true'
        }">
            <button @click="openSection = !openSection"
                class="flex justify-between w-full py-2.5 px-4 transition duration-200 hover:bg-gray-200
                    @if (Request::is('Kategori*')) bg-gray-200 @endif">
                <span class="flex items-center">
                    <img src="{{ asset('svg/airplay.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Kategori</span>
                </span>
                <img src="{{ asset('svg/chevron-down.svg') }}" :class="{ 'rotate-180': openSection }"
                    class="h-5 w-5 transition-transform duration-800" />
            </button>
            <div x-show="openSection" class="pl-4">
                <a href="/Kategori/pengolahan"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('Kategori/pengolahan')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/activity.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Pengolahan</span>
                </a>
                <a href="/Kategori/tata-usaha"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('Kategori/tata-usaha')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/file-text.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Tata Usaha</span>
                </a>
                <a href="/Kategori/sosial"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('Kategori/sosial')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/users.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Sosial</span>
                </a>
                <a href="/Kategori/ekonomi"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('Kategori/ekonomi')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/dollar-sign.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Ekonomi</span>
                </a>
            </div>
        </div>
        <div x-data="{
            openLink: '{{ Request::is('link', 'link/create') ? 'true' : 'false' }}' === 'true'
        }">
            <button @click="openLink = !openLink"
                class="flex justify-between w-full py-2.5 px-4 transition duration-200 hover:bg-gray-200
                    ">
                <span class="flex items-center">
                    <img src="{{ asset('svg/Link.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Link</span>
                </span>
                <img src="{{ asset('svg/chevron-down.svg') }}" :class="{ 'rotate-180': openLink }"
                    class="h-5 w-5 transition-transform duration-800" />
            </button>
            <div x-show="openLink" class="pl-4">
                <a href="/link"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('link')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/file-text.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Daftar</span>
                </a>
                <a href="/link/create"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('link/create')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/file-text.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Tambah</span>
                </a>
                <a href="/link/kelola"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('link/kelola')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/file-text.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Kelola</span>
                </a>

            </div>
        </div>
        <div x-data="{
            openManage: '{{ Request::is('link/approval', 'users/create', 'users/kelola') ? 'true' : 'false' }}' === 'true'
        }">
            <button @click="openManage = !openManage"
                class="flex justify-between w-full py-2.5 px-4 transition duration-200 hover:bg-gray-200
                    ">
                <span class="flex items-center">
                    <img src="{{ asset('svg/airplay.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Manage</span>
                </span>
                <img src="{{ asset('svg/chevron-down.svg') }}" :class="{ 'rotate-180': openManage }"
                    class="h-5 w-5 transition-transform duration-800" />
            </button>
            <div x-show="openManage" class="pl-4">
                <a href="/link/approval"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('link/approval')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/users.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Approval</span>
                </a>
                <a href="/users/create"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('users/create')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/activity.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Buat Akun</span>
                </a>
                <a href="/users/kelola"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('users/kelola')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/dollar-sign.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Kelola Akun</span>
                </a>
            </div>
        </div>
    </nav>
</div>
