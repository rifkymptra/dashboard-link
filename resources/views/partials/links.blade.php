@foreach ($links as $link)
    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <td class="px-6 py-4">{{ $link->link_name }} @if ($link->vpn)
                <span class="bg-cyan-400 p-1 text-[8px] md:text-[10px] font-bold rounded-full">
                    VPN!
                </span>
            @endif
        </td>
        <td class="px-6 py-4">{{ $link->description_link }}</td>
        <td class="px-6 py-4 hidden md:table-cell">{{ $link->sectionId->section_name }}</td>
        <td class="px-6 py-4">
            <a href="{{ $link->url }}" class="text-blue-600 hover:underline">{{ $link->url }}</a>
        </td>
        @if (auth()->user()->role === 'admin')
            <td class="px-6 py-4 text-right">
                <button @click="editLink({{ $link->id }}); showEditModal = true;"
                    class="font-medium text-blue-600 hover:underline">Edit</button>
            </td>
        @endif
    </tr>
@endforeach
