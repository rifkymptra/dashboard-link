<header class="antialiased border-b border-gray-200 fixed z-50 w-full">
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800" x-data="{ open: true }"
        x-init="if (window.matchMedia('(max-width: 768px)').matches) {
            open = false;
        }">
        <div class="flex flex-wrap justify-between items-center">
            <!-- Left side -->
            <div class="flex justify-start items-center">
                <!-- Toggle sidebar button (hidden on larger screens) -->
                <button @click="open = !open; $dispatch('toggle-sidebar', { open: open })"
                    class="text-black focus:outline-none pr-2">
                    <img x-show="open" src="{{ asset('svg/x.svg') }}" class="lg:h-8 lg:w-8 sm:h-7 sm:w-7 h-6 w-6" />
                    <img x-show="!open" src="{{ asset('svg/align-left.svg') }}"
                        class="lg:h-8 lg:w-8 sm:h-7 sm:w-7 h-6 w-6" />
                </button>

                <!-- Logo and site title -->
                <a href="/beranda" class="flex mr-4">
                    <img src="{{ asset('bps_logo.png') }}" class="mr-3 md:h-8 sm:h-7 h-6" alt="FlowBite Logo" />
                    <span
                        class="self-center sm:text-lg md:text-2xl text-sm font-semibold whitespace-nowrap dark:text-white">DataLink
                        Explorer</span>
                </a>
            </div>
            <!-- Right side -->
            <div class="flex items-center lg:order-2">
                <h2
                    class="relative text-black rounded-lg text-blue hover:shadow-2xl transform transition-transform duration-500 hover:scale-105 hover:rotate-1">
                    <span class="text-xs hidden sm:block md:block sm:text-sm lg:text-base">Halo,
                        {{ Auth::user()->name }}</span>
                    <span class="absolute inset-0 from-pink-300 to-orange-300 opacity-25 rounded-lg -z-10"></span>
                </h2>

                <!-- Profile button with dropdown -->
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen"
                        class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="{{ asset('bps_logo.png') }}" alt="user photo">
                    </button>
                    <!-- Dropdown menu -->
                    <div x-show="isOpen" @click.away="isOpen = false"
                        class="absolute right-0 mt-2 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown" style="display: none;">
                        <div class="py-3 px-4">
                            <span
                                class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            <span
                                class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
                        <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                            <li>
                                <a href="/profile"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My
                                    profile</a>
                            </li>
                        </ul>
                        <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full py-2 px-4 text-sm text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
