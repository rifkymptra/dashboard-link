<div>
    @if ($type === 'daily')
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jumlah Pengunjung
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $startDate = Carbon\Carbon::now()->subDays(6);
                    $dates = [];
                    for ($i = 0; $i < 7; $i++) {
                        $dates[] = $startDate->copy()->addDays($i)->format('Y-m-d');
                    }
                @endphp
                @foreach ($dates as $date)
                    @php
                        $count = $data->firstWhere('date', $date)?->count ?? 0;
                        $dayName = Carbon\Carbon::parse($date)->translatedFormat('l');
                        $dayNameInIndonesian =
                            [
                                'Sunday' => 'Minggu',
                                'Monday' => 'Senin',
                                'Tuesday' => 'Selasa',
                                'Wednesday' => 'Rabu',
                                'Thursday' => 'Kamis',
                                'Friday' => 'Jumat',
                                'Saturday' => 'Sabtu',
                            ][$dayName] ?? $dayName;
                        $formattedDate = Carbon\Carbon::parse($date)->translatedFormat('j F Y');
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $dayNameInIndonesian }}, {{ $formattedDate }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $count }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif ($type === 'monthly')
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jumlah Pengunjung
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $startDate = Carbon\Carbon::now()->subDays(29);
                    $dates = [];
                    for ($i = 0; $i < 30; $i++) {
                        $dates[] = $startDate->copy()->addDays($i)->format('Y-m-d');
                    }
                @endphp
                @foreach ($dates as $date)
                    @php
                        $count = $data->firstWhere('date', $date)?->count ?? 0;
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $count }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif($type === 'yearly')
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Bulan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jumlah Pengunjung
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $months = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember',
                    ];
                    $startDate = Carbon\Carbon::now()->subYear();
                    $dates = [];
                    for ($i = 0; $i < 12; $i++) {
                        $dates[] = $startDate->copy()->addMonths($i);
                    }
                @endphp
                @foreach ($dates as $date)
                    @php
                        $month = $date->month;
                        $year = $date->year;
                        $count = $data->firstWhere('month', $month)?->count ?? 0;
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $months[$month] }} {{ $year }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $count }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
