<x-layout>
    <div class="flex min-h-full flex-col justify-center px-6 pt-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="/beranda" class="flex mr-4 justify-center">
                <img src="{{ asset('bps_logo.png') }}" class="mr-3 md:h-14 sm:h-7 h-6" alt="FlowBite Logo" />
                <span
                    class="self-center sm:text-lg md:text-2xl text-sm font-semibold whitespace-nowrap dark:text-white italic">DataLink
                    Explorer</span>
            </a>
            <h2 class="mt-4 text-center text-2xl md:text-4xl font-bold leading-9 tracking-tight text-gray-900">Sign in
            </h2>
            <h2 class="text-center text-sm md:text-lg leading-9 tracking-tight text-gray-900">Gunakan Akun BPS Anda
            </h2>
        </div>

        <div class="mt-0 md:mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-2 md:space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email"
                        class="block text-xs md:text-sm font-medium leading-3 md:leading-6 text-gray-900">Email</label>
                    <div class="mt-1 md:mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password"
                            class="block text-xs md:text-sm font-medium leading-6 text-gray-900">Password</label>
                    </div>
                    <div class="mt-1 md:mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button>
                </div>
            </form>


            <p class="mt-10 text-center text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                Penyedia Data Statistik Berkualitas untuk Indonesia Maju
            </p>
        </div>
    </div>

    <x-footer></x-footer>

</x-layout>
