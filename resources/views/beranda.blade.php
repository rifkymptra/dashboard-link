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
            <x-summary-card icon="svg/airplay.svg" title="Jumlah Seksi" description="{{ count($sections) }}" />
            <x-summary-card icon="svg/link.svg" title="Jumlah Link" description="{{ count($links) }}" />
            @if (auth()->user()->role === 'admin')
                <x-summary-card icon="svg/file-plus.svg" title="Link Baru"
                    description="{{ count($links->where('status', 'submitted')) }}" />
            @endif
        </div>

        <!-- Pintasan Section -->
        <h2 class="text-2xl font-bold mt-10 mb-4">Pintasan</h2>
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-shortcut-card href="/link" icon="svg/link.svg" title="Link"
                description="Rangkuman link yang digunakan" />
            @if (auth()->user()->role === 'admin')
                <x-shortcut-card href="/link/approval" icon="svg/airplay.svg" title="Approval"
                    description="Pengajuan link yang belum disetujui" />
            @endif
            @if (auth()->user()->role === 'user')
                <x-shortcut-card href="/profile" icon="svg/users.svg" title="Profile"
                    description="Edit profil & ganti password" />
            @endif
            <x-shortcut-card href="/link/create" icon="svg/book.svg" title="Buat Baru"
                description="Ajukan sebuah link baru!" />
        </div>

        <!-- Grafik Section -->
        <h2 class="text-2xl font-bold mt-10 mb-4">Grafik</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Bar Chart for Links by Section -->
            <div class="bg-white p-4 shadow rounded-lg">
                <canvas id="linksBySectionChart"></canvas>
            </div>

            <!-- Line Chart for Monthly Link Trends -->
            <div class="bg-white p-4 shadow rounded-lg">
                <canvas id="monthlyLinkTrendsChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data for Links by Section Bar Chart
            const linksBySectionCtx = document.getElementById('linksBySectionChart').getContext('2d');
            new Chart(linksBySectionCtx, {
                type: 'bar',
                data: {
                    labels: @json($linksBySection->keys()),
                    datasets: [{
                        label: 'Jumlah Link',
                        data: @json($linksBySection->values()),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Data for Monthly Link Trends Line Chart
            const monthlyLinkTrendsCtx = document.getElementById('monthlyLinkTrendsChart').getContext('2d');
            new Chart(monthlyLinkTrendsCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyLinkCounts->pluck('month')),
                    datasets: [{
                        label: 'Jumlah Link per Bulan',
                        data: @json($monthlyLinkCounts->pluck('count')),
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-layout>
