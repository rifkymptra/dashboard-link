<div :class="open ? 'w-64' : 'w-0'"
    class="bg-white text-black min-h-screen transition-all duration-300 fixed md:relative z-50 md:z-auto">
    <nav class="mt-10">
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
            <img src="{{ asset('svg/home.svg') }}" class="inline-block h-6 w-6 mr-3" />
            <span :class="open ? 'inline' : 'hidden'">Beranda</span>
        </a>
        <div x-data="{ openSection: false }">
            <button @click="openSection = !openSection"
                class="flex justify-between w-full py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
                <span class="flex items-center">
                    <img src="{{ asset('svg/airplay.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Seksi</span>
                </span>
                <img src="{{ asset('svg/chevron-down.svg') }}" :class="{ 'rotate-180': openSection }"
                    class="h-5 w-5 transition-transform duration-800" />
            </button>
            <div x-show="openSection" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 translate-y-20%"
                x-transition:enter-end="transform opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="transform opacity-100 translate-y-0"
                x-transition:leave-end="transform opacity-0 translate-y-20%" class="pl-4">
                <a href="#"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black">
                    <img src="{{ asset('svg/activity.svg') }}" class="inline-block h-6 w-6 mr-3 " />
                    <span :class="open ? 'inline' : 'hidden'">Pengolahan</span>
                </a>
                <a href="#"
                    class="block py-2.5 px-4  transition duration-200 hover:bg-gray-200 border-l border-black">
                    <img src="{{ asset('svg/file-text.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Tata Usaha</span>
                </a>
                <a href="#"
                    class="block py-2.5 px-4  transition duration-200 hover:bg-gray-200 border-l border-black">
                    <img src="{{ asset('svg/users.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Sosial</span>
                </a>
                <a href="#"
                    class="block py-2.5 px-4  transition duration-200 hover:bg-gray-200 border-l border-black">
                    <img src="{{ asset('svg/dollar-sign.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Ekonomi</span>
                </a>
            </div>
        </div>
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
            <img src="{{ asset('svg/link.svg') }}" class="inline-block h-6 w-6 mr-3" />
            <span :class="open ? 'inline' : 'hidden'">Link</span>
        </a>
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
            <img src="{{ asset('svg/book.svg') }}" class="inline-block h-6 w-6 mr-3" />
            <span :class="open ? 'inline' : 'hidden'">Management</span>
        </a>
    </nav>
</div>
