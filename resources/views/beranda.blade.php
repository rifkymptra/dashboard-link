<x-layout>

    <section
        class="bg-gradient-to-br -ml-4 from-gray-900 via-gray-800 to-transparent text-white -mt-8 pb-40 pt-20 relative px-0">
        <div class="container mx-auto flex flex-col-reverse lg:flex-row items-center">
            <!-- Text Content -->
            <div class="lg:w-1/2 text-center lg:text-left lg:pr-10">
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                    Temukan Website yang Anda Butuhkan di <span class="text-teal-300">DataLink Explorer</span>
                </h1>
                <p class="text-lg lg:text-xl mb-8">
                    Sebuah dashboard yang menyimpan seluruh link website dalam pelaksanaan tugas di lingkungan BPS Kota
                    Solok.
                </p>
                <a href="/link"
                    class="inline-block bg-teal-400 text-black font-semibold py-3 px-6 rounded-full hover:bg-teal-500 transition duration-300">
                    Temukan Website
                </a>
            </div>
            <!-- Image Content -->
            <div class="lg:w-1/3 w-1/4 justify-center items-center flex mb-10 lg:mb-20 ml-28">
                <img src="{{ asset('bps_logo.png') }}" alt="Data Visualization"
                    class="w-full rounded-lg animate-bounce-vertical">
            </div>
        </div>
        <!-- Gradient Overlay for Smooth Transition -->
        <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- Content Section (white background) -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 py-8">

            <!-- Text Content -->
            @if (!auth()->user())
                <div class="text-justify mx-auto">
                    <div class="flex flex-col lg:flex-row items-center justify-between mb-16">
                        <div class="lg:w-3/5 mb-8 lg:mb-0 bg-gray-900 rounded-xl px-8 pb-4 pt-8 text-white">
                            <h2 class="text-3xl font-bold mb-4 text-teal-300">Temukan Website Anda Sekarang!</h2>
                            <p class="text-lg mb-6 px-10">
                                Pembuatan website ini didasarkan pada kebutuhan akan website yang semakin banyak dalam
                                melaksanakan
                                pekerjaan sehari-hari, yang mana bisa saja ketika seorang pegawai dipindahtugaskan, link
                                website
                                yang
                                dipergunakan dalam satuan kerja tersebut hanya diketahui oleh pegawai tersebut. Sehingga
                                dibuatlah DataLink
                                Explorer untuk memudahkan pencarian website yang dipergunakan dalam tugas di Badan Pusat
                                Statistik.
                            </p>
                            <a href="/link"
                                class=" ml-2 relative inline-flex items-center justify-center p-0.5 overflow-hidden text-md font-bold text-gray-900 rounded-3xl group bg-gradient-to-br from-cyan-500 to-teal-500 group-hover:from-cyan-500 group-hover:to-teal-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-teal-200 dark:focus:ring-cyan-800">
                                <span
                                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-3xl group-hover:bg-opacity-0">
                                    Temukan!
                                </span>
                            </a>
                        </div>
                        <div class="lg:w-1/4 mr-28">
                            <img src="{{ asset('temukan.png') }}" alt="Find Your Website"
                                class="w-full max-w-md mx-auto">
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="flex flex-col lg:flex-row items-center justify-between pt-12">
                        <div class="lg:w-1/4 ml-28">
                            <img src="{{ asset('ajukan.png') }}" alt="Submit Your Website"
                                class="w-full max-w-md mx-auto">
                        </div>
                        <div class="lg:w-3/5 mb-8 lg:mb-0">
                            <h2 class="text-3xl font-bold mb-4">Ajukan Website Baru!</h2>
                            <p class="text-lg">
                                Terdapat website yang dipergunakan namun belum ada di list kami?
                            </p>
                            <p class="text-lg mb-6">Anda dapat mengajukan website untuk ditampilkan setelah disetujui
                                oleh
                                admin.</p>
                            <a href="/link/create"
                                class="ml-2 relative inline-flex items-center justify-center p-0.5 overflow-hidden text-md font-bold text-gray-900 rounded-3xl group bg-gradient-to-br from-cyan-500 to-teal-500 group-hover:from-cyan-500 group-hover:to-teal-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-teal-200 dark:focus:ring-cyan-800">
                                <span
                                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-3xl group-hover:bg-opacity-0">
                                    Ajukan!
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif


            @if (auth()->user())
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

                <!-- Rangkuman Section -->
                <div>
                    <h2 class="text-2xl font-bold mt-10 mb-4">Rangkuman</h2>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <x-summary-card icon="svg/airplay.svg" title="Jumlah Seksi"
                            description="{{ count($sections) }}" />
                        <x-summary-card icon="svg/link.svg" title="Jumlah Link"
                            description="{{ count($links->where('status', 'approved')) }}" />
                        <x-summary-card icon="svg/file-plus.svg" title="Link Belum Disetujui"
                            description="{{ count($links->where('status', 'submitted')) }}" />
                    </div>
                </div>

                <!-- Pintasan Section -->
                <div>
                    <h2 class="text-2xl font-bold mt-10 mb-4">Pintasan</h2>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <x-shortcut-card href="/link" icon="svg/link.svg" title="Link"
                            description="Rangkuman link yang digunakan" />
                        <x-shortcut-card href="/link/approval" icon="svg/airplay.svg" title="Approval"
                            description="Pengajuan link yang belum disetujui" />
                        <x-shortcut-card href="/link/create" icon="svg/book.svg" title="Buat Baru"
                            description="Ajukan sebuah link baru!" />
                    </div>
                </div>

                {{-- Visitor Statistics --}}
                <x-visitor-report />
            @endif
        </div>
    </section>

    <x-footer> </x-footer>


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
