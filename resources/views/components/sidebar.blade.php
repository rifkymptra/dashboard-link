<div :class="open ? 'w-64' : 'w-0'"
    class="bg-white text-black min-h-screen transition-all duration-300 fixed md:relative z-50 md:z-auto border-r border-gray-200 top-5">
    <nav class="mt-10 transition-all duration-300" :class="open ? 'block' : 'hidden'">
        <a href="/beranda"
            class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200
            @if (Request::is('beranda')) bg-gray-200 @endif">
            <img src="{{ asset('svg/home.svg') }}" class="inline-block h-6 w-6 mr-3" />
            <span :class="open ? 'inline' : 'hidden'">Beranda</span>
        </a>
        <div x-data="{ openSection: false }">
            <button @click="openSection = !openSection"
                class="flex justify-between w-full py-2.5 px-4 transition duration-200 hover:bg-gray-200
                    @if (Request::is('seksi*')) bg-gray-200 @endif">
                <span class="flex items-center">
                    <img src="{{ asset('svg/airplay.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Seksi</span>
                </span>
                <img src="{{ asset('svg/chevron-down.svg') }}" :class="{ 'rotate-180': openSection }"
                    class="h-5 w-5 transition-transform duration-800" />
            </button>
            <div x-show="openSection" class="pl-4">
                <a href="/seksi/pengolahan"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('seksi/pengolahan')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/activity.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Pengolahan</span>
                </a>
                <a href="/seksi/tata-usaha"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('seksi/tata-usaha')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/file-text.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Tata Usaha</span>
                </a>
                <a href="/seksi/sosial"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('seksi/sosial')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/users.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Sosial</span>
                </a>
                <a href="/seksi/ekonomi"
                    class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200 border-l border-black
                        @if (Request::is('seksi/ekonomi')) bg-gray-200 @endif">
                    <img src="{{ asset('svg/dollar-sign.svg') }}" class="inline-block h-6 w-6 mr-3" />
                    <span :class="open ? 'inline' : 'hidden'">Ekonomi</span>
                </a>
            </div>
        </div>
        <a href="/link"
            class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200
            @if (Request::is('link')) bg-gray-200 @endif">
            <img src="{{ asset('svg/link.svg') }}" class="inline-block h-6 w-6 mr-3" />
            <span :class="open ? 'inline' : 'hidden'">Link</span>
        </a>
        <a href="/management"
            class="block py-2.5 px-4 transition duration-200 hover:bg-gray-200
            @if (Request::is('management')) bg-gray-200 @endif">
            <img src="{{ asset('svg/book.svg') }}" class="inline-block h-6 w-6 mr-3" />
            <span :class="open ? 'inline' : 'hidden'">Management</span>
        </a>
    </nav>
</div>
