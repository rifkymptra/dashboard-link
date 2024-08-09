<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2>Beranda</h2>
        <h1 class="text-3xl font-bold mb-4">Selamat datang!</h1>

        <!-- Grafik Section -->
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

    <!-- Rangkuman Section -->
    <h2 class="text-2xl font-bold mt-10 mb-4">Rangkuman</h2>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-summary-card icon="svg/airplay.svg" title="Jumlah Seksi" description="{{ count($sections) }}" />
        <x-summary-card icon="svg/link.svg" title="Jumlah Link" description="{{ count($links) }}" />
        @if (auth()->user()->role === 'admin')
            <x-summary-card icon="svg/file-plus.svg" title="Link Belum Disetujui"
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gradient for Bar Chart
            const linksBySectionCtx = document.getElementById('linksBySectionChart').getContext('2d');
            const linksBySectionGradient = linksBySectionCtx.createLinearGradient(0, 0, 0, 400);
            linksBySectionGradient.addColorStop(0, 'rgba(54, 162, 235, 0.2)');
            linksBySectionGradient.addColorStop(1, 'rgba(54, 162, 235, 0.05)');

            new Chart(linksBySectionCtx, {
                type: 'bar',
                data: {
                    labels: @json($linksBySection->keys()),
                    datasets: [{
                        label: 'Jumlah Link Per Kategori',
                        data: @json($linksBySection->values()),
                        backgroundColor: linksBySectionGradient,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        hoverBackgroundColor: 'rgba(54, 162, 235, 0.3)',
                        hoverBorderColor: 'rgba(54, 162, 235, 1)',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                display: false,
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [3, 3],
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Link Per Kategori',
                            color: '#000',
                            font: {
                                size: 16,
                            }
                        }
                    }
                }
            });

            // Gradient for Line Chart
            const monthlyLinkTrendsCtx = document.getElementById('monthlyLinkTrendsChart').getContext('2d');
            const monthlyLinkTrendsGradient = monthlyLinkTrendsCtx.createLinearGradient(0, 0, 0, 400);
            monthlyLinkTrendsGradient.addColorStop(0, 'rgba(75, 192, 192, 0.2)');
            monthlyLinkTrendsGradient.addColorStop(1, 'rgba(75, 192, 192, 0.05)');

            new Chart(monthlyLinkTrendsCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyLinkCounts->pluck('month')),
                    datasets: [{
                        label: 'Jumlah Tambahan Link per Bulan',
                        data: @json($monthlyLinkCounts->pluck('count')),
                        fill: true,
                        backgroundColor: monthlyLinkTrendsGradient,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                display: false,
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [3, 3],
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Tambahan Link per Bulan',
                            color: '#000',
                            font: {
                                size: 16,
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layout>
