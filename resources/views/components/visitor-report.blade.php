<div class="bg-white overflow-hidden sm:rounded-lg py-6">
    <h2 class="text-2xl font-bold mb-4">Kunjungan</h2>
    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="bg-gray-100 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Pengunjung Hari Ini</h3>
            <p class="text-xl font-bold text-gray-900">{{ $todayCount }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Pengunjung Minggu Ini</h3>
            <p class="text-xl font-bold text-gray-900">{{ $weekCount }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Pengunjung Bulan Ini</h3>
            <p class="text-xl font-bold text-gray-900">{{ $monthCount }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Pengunjung Tahun Ini</h3>
            <p class="text-xl font-bold text-gray-900">{{ $yearCount }}</p>
        </div>
    </div>
</div>
