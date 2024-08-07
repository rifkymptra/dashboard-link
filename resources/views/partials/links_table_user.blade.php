@foreach ($links as $link)
    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <td class="px-2 sm:px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $link->link_name }} @if ($link->vpn)
                <span class="bg-cyan-400 p-1 text-[10px] font-bold rounded-full">VPN!</span>
            @endif
        </td>
        <td class="px-2 sm:px-6 py-4">{{ $link->description_link }}</td>
        <td class="px-2 sm:px-6 py-4">
            <a href="{{ $link->url }}" class="text-blue-600 hover:underline">{{ $link->url }}</a>
        </td>
        <td class="px-2 sm:px-6 py-4">{{ $link->status }}</td>
        <td class="px-2 sm:px-6 py-4">{{ $link->note }}</td>
    </tr>
@endforeach
