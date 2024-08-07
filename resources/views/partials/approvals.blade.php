@foreach ($links as $link)
    <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
        <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $link->link_name }}
            @if ($link->vpn)
                <span class="bg-cyan-400 p-1 text-[8px] md:text-[10px] font-bold rounded-full">VPN!</span>
            @endif
        </th>
        <td class="px-2 py-4">{{ $link->description_link }}</td>
        <td class="px-2 py-4">{{ $link->submittedBy->section->section_name }}</td>
        <td class="px-2 py-4 max-w-xs">
            <a href="{{ $link->url }}" class="text-blue-600 hover:underline">{{ $link->url }}</a>
        </td>
        <td class="px-2 py-4 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
            <form id="approve-form-{{ $link->id }}" action="{{ route('approval.accept', $link->id) }}"
                method="POST" class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                    class="approveButton text-xs md:text-sm w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-0 py-2 md:px-5 md:py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setuju</button>
            </form>
            <form id="reject-form-{{ $link->id }}" action="{{ route('approval.reject', $link->id) }}" method="POST"
                class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                    class="rejectButton text-xs md:text-sm w-full sm:w-auto text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full px-3 py-2 md:px-5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Tolak</button>
            </form>

        </td>
    </tr>
@endforeach
