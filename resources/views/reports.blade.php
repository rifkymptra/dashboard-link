<x-layout>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900">Laporan Kunjungan</h2>
            <div class="mt-4">
                <label for="report-type" class="block text-sm font-medium text-gray-700">Tipe Laporan</label>
                <select id="report-type" name="report-type"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="daily">Harian</option>
                    <option value="monthly">Bulanan</option>
                    <option value="yearly">Tahunan</option>
                </select>
            </div>

            <div id="report-content" class="mt-4">
                <!-- Report Table -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reportTypeSelect = document.getElementById('report-type');
            const reportContent = document.getElementById('report-content');

            function fetchReport(type) {
                fetch(`/reports/${type}`)
                    .then(response => response.text())
                    .then(html => {
                        reportContent.innerHTML = html;
                    })
                    .catch(error => console.error('Error fetching report:', error));
            }

            reportTypeSelect.addEventListener('change', function() {
                fetchReport(this.value);
            });

            // Load default report
            fetchReport('daily');
        });
    </script>
</x-layout>
