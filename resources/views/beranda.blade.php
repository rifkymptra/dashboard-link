<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2>Beranda</h2>
        <h1 class="text-3xl font-bold mb-4">Selamat datang!</h1>

        <!-- Pengumuman Section -->
        <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M9 12h2v2H9v-2zm0-7h2v5H9V5zm9-2H2C.9 3 .01 3.9.01 5L0 15c0 1.1.9 2 2 2h6v2h4v-2h6c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 12H2V5h16v10z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Pengumuman</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Jangan lupa ibadah. </li>
                        <li>Jika ingin menambahkan link baru, klik pada menu link. </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Rangkuman Section -->
        <h2 class="text-2xl font-bold mt-10 mb-4">Rangkuman</h2>
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-summary-card icon="svg/airplay.svg" title="Jumlah Seksi" description="5" />
            <x-summary-card icon="svg/link.svg" title="Jumlah Link" description="20" />
            <x-summary-card icon="svg/file-plus.svg" title="Link Baru" description="3" />
        </div>

        <!-- Pintasan Section -->
        <h2 class="text-2xl font-bold mt-10 mb-4">Pintasan</h2>
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-shortcut-card href="/beranda" icon="svg/airplay.svg" title="Seksi"
                description="Seluruh seksi di BPS Kota Solok" />
            <x-shortcut-card href="/beranda" icon="svg/link.svg" title="Link"
                description="Rangkuman link yang digunakan" />
            <x-shortcut-card href="/beranda" icon="svg/book.svg" title="Manajemen"
                description="Organisir link-link yang ada" />
        </div>


    </div>
</x-layout>
